<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Mary\Traits\Toast;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;

new #[Layout('developers::components.layouts.admin')] class extends Component {
    use Toast;
    use WithPagination;

    public $user;
    public $pageTitle = 'Arabhardware | Developers';
    public $list;
    public $headers;
    public $search = '';
    public $filteredList;
    public $loading = false;
    public $page = 1;
    public $perPage = 25;
    public $total = 0;
    public $hasMorePage = false;
    public $perPageOptions = [
        ['id' => 10, 'name' => 10],
        ['id' => 25, 'name' => 25],
        ['id' => 50, 'name' => 50],
        ['id' => 100, 'name' => 100]
    ];
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $sortBy = ['column' => 'created_at', 'direction' => 'desc'];

    public function mount()
    {
        $this->user = Auth::user();
        $this->page = 1;
        $this->perPage = 25;
        $this->loadClientsData();
        $this->headers = [
            ['key' => 'icon', 'label' => '', 'class' => 'w-12'],
            ['key' => 'name', 'label' => 'App Name'],
            ['key' => 'client_id', 'label' => 'Client ID'],
            ['key' => 'grant_types', 'label' => 'Grant Types'],
            ['key' => 'created_at', 'label' => 'Created'],
            ['key' => 'revoked', 'label' => 'Status'],
            ['key' => 'actions', 'label' => 'Actions', 'class' => 'text-center'],
        ];
    }

    public function loadClientsData()
    {
        try {
            $this->loading = true;

            // Get OAuth clients for the authenticated user
            $clients = $this->user->oauthApps()
                ->when($this->sortBy['column'] === 'created_at', function ($query) {
                    return $query->orderBy('created_at', $this->sortBy['direction']);
                })
                ->when($this->sortBy['column'] === 'name', function ($query) {
                    return $query->orderBy('name', $this->sortBy['direction']);
                })
                ->get();

            // Transform the data to match the table structure
            $transformed = $clients->map(function ($client) {
                return [
                    'id' => $client->id,
                    'name' => $client->name ?? 'Unnamed App',
                    'client_id' => $client->id,
                    'client_secret' => $client->secret,
                    'redirect' => $client->redirect,
                    'grant_types' => $this->getGrantTypes($client),
                    'created_at' => $client->created_at ? $client->created_at->format('M d, Y') : '-',
                    'revoked' => $client->revoked ? 'Revoked' : 'Active',
                    'icon' => $client->id, // For icon display
                    'actions' => $client->id, // For action buttons
                ];
            });

            $this->list = collect($transformed);
            $this->filteredList = $this->list;
            $this->total = $this->list->count();

            // Apply pagination logic
            $this->applyPagination();

            $this->loading = false;
        } catch (Exception $e) {
            $this->loading = false;
            $this->error('Error loading OAuth clients: ' . $e->getMessage(), position: 'bottom-right');
        }
    }

    private function getGrantTypes($client)
    {
        $grantTypes = [];

        if ($client->personal_access_client) {
            $grantTypes[] = 'Personal Access';
        }
        if ($client->password_client) {
            $grantTypes[] = 'Password';
        }
        if (!$client->personal_access_client && !$client->password_client) {
            $grantTypes[] = 'Authorization Code';
        }

        return implode(', ', $grantTypes);
    }

    private function applyPagination()
    {
        $offset = ($this->page - 1) * $this->perPage;
        $this->filteredList = $this->filteredList->slice($offset, $this->perPage);
        $this->hasMorePage = $this->total > ($this->page * $this->perPage);
    }

    public function refreshMyApps()
    {
        $this->loadClientsData();
        $this->success('OAuth apps refreshed successfully!', position: 'bottom-right');
    }

    public function goToPage($page)
    {
        $this->page = $page;
        $this->loadClientsData();
    }

    public function updatedPerPage()
    {
        $this->page = 1; // Reset to first page when changing per page
        $this->loadClientsData();
    }

    public function updatedSearch()
    {
        $this->page = 1;
        if (empty($this->search)) {
            $this->filteredList = $this->list;
            $this->applyPagination();
            return;
        }

        $filtered = $this->list->filter(function ($client) {
            $searchTerm = strtolower($this->search);
            return str_contains(strtolower($client['name']), $searchTerm) ||
                   str_contains(strtolower($client['client_id']), $searchTerm) ||
                   str_contains(strtolower($client['grant_types']), $searchTerm);
        });

        $this->total = $filtered->count();
        $this->filteredList = $filtered;
        $this->applyPagination();
    }

    public function updatedSortBy()
    {
        $this->page = 1; // Reset to first page when sorting
        $this->loadClientsData();
    }

    public function viewClient($clientId)
    {
        $this->info('Viewing OAuth client: ' . $clientId, position: 'bottom-right');
        // You can redirect to a view page or open a modal
        // return redirect()->route('developers.apps.show', $clientId);
    }

    public function editClient($clientId)
    {
        //$this->warning('Editing OAuth client: ' . $clientId, position: 'bottom-right');
        // You can redirect to an edit page
        return redirect()->route('developers.apps.edit', $clientId);
    }

    public function revokeClient($clientId)
    {
        try {
            $client = $this->user->oauthApps()->find($clientId);
            if ($client) {
                $client->update(['revoked' => true]);
                $this->success('OAuth client revoked successfully!', position: 'bottom-right');
                $this->refreshMyApps();
            } else {
                $this->error('OAuth client not found!', position: 'bottom-right');
            }
        } catch (Exception $e) {
            $this->error('Error revoking OAuth client: ' . $e->getMessage(), position: 'bottom-right');
        }
    }

    public function restoreClient($clientId)
    {
        try {
            $client = $this->user->oauthApps()->find($clientId);
            if ($client) {
                $client->update(['revoked' => false]);
                $this->success('OAuth client restored successfully!', position: 'bottom-right');
                $this->refreshMyApps();
            } else {
                $this->error('OAuth client not found!', position: 'bottom-right');
            }
        } catch (Exception $e) {
            $this->error('Error restoring OAuth client: ' . $e->getMessage(), position: 'bottom-right');
        }
    }

    public function deleteClient($clientId)
    {
        try {
            $client = $this->user->oauthApps()->find($clientId);
            if ($client) {
                $client->delete();
                $this->success('OAuth client deleted successfully!', position: 'bottom-right');
                $this->refreshMyApps();
            } else {
                $this->error('OAuth client not found!', position: 'bottom-right');
            }
        } catch (Exception $e) {
            $this->error('Error deleting OAuth client: ' . $e->getMessage(), position: 'bottom-right');
        }
    }
}; ?>
<div class="max-w-7xl mx-auto min-h-screen ">
    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <section class="w-full">

             <x-mary-header icon="o-code-bracket" icon-classes="bg-primary text-white rounded-full p-1 w-6 h-6"
                    title="My Apps" subtitle="List of all your OAuth applications" separator progress-indicator="save"
                    progress-indicator-class="progress-primary">
                    <x-slot:middle class="!justify-end">
                        <x-mary-input wire:model.live="search" icon="o-magnifying-glass"
                            placeholder="Search your apps..." />
                    </x-slot:middle>
                    <x-slot:actions>
                        <x-mary-select wire:model.live="perPage" :options="$perPageOptions" class="w-20 btn-sm" />
                        <x-mary-button wire:click="refreshMyApps" icon="o-arrow-path" class="btn-sm"
                            :loading="$loading" title="Refresh your apps" />
                        <x-mary-button link="{{ route('developers.apps.create') }}" icon="o-plus"
                            class="btn-primary btn-sm" />
                    </x-slot:actions>
                </x-mary-header>

                <div wire:loading>
                    <div class="w-full">
                        <table class="table table-zebra w-full min-w-full">
                            <thead>
                                <tr>
                                    @foreach($headers as $header)
                                        <th class="{{ $header['class'] ?? '' }}">
                                            <div class="skeleton h-8 w-full min-w-full"></div>
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < 9; $i++)
                                    <tr>
                                        @foreach($headers as $header)
                                            <td class="{{ $header['class'] ?? '' }}">
                                                @if(isset($header['key']) && $header['key'] === 'icon')
                                                    <div class="skeleton h-12 w-12 rounded-lg mx-auto"></div>
                                                @elseif(isset($header['key']) && $header['key'] === 'actions')
                                                    <div class="flex gap-1 justify-center">
                                                        <div class="skeleton h-10 w-10 rounded"></div>
                                                        <div class="skeleton h-10 w-10 rounded"></div>
                                                        <div class="skeleton h-10 w-10 rounded"></div>
                                                    </div>
                                                @else
                                                    <div class="skeleton h-10 w-full min-w-full"></div>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                <div wire:loading.remove>
                    <x-mary-table :headers="$headers" :rows="$filteredList" class="table-zebra" sortable wire:model.live="sortBy">
                        {{-- Icon column styling --}}
                        @scope('cell_icon', $row)
                            <div class="flex items-center justify-center">
                                <div class="w-10 h-10 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <x-mary-icon name="o-code-bracket" class="w-6 h-6 text-primary" />
                                </div>
                            </div>
                        @endscope

                        {{-- Client ID column styling --}}
                        @scope('cell_client_id', $row)
                            <code class="text-xs {{-- bg-gray-100 --}} px-2 py-1 rounded">{{ $row['client_id'] }}</code>
                        @endscope

                        {{-- Grant Types column styling --}}
                        @scope('cell_grant_types', $row)
                            <span class="text-sm text-gray-600">{{ $row['grant_types'] }}</span>
                        @endscope

                        {{-- Status column styling --}}
                        @scope('cell_revoked', $row)
                            @if($row['revoked'] === 'Active')
                                <x-mary-badge value="Active" class="badge-success badge-sm" />
                            @else
                                <x-mary-badge value="Revoked" class="badge-error badge-sm" />
                            @endif
                        @endscope

                        {{-- Actions column styling --}}
                        @scope('cell_actions', $row)
                            <div class="flex gap-1 justify-center">
                                <x-mary-button
                                    class="btn-sm btn-ghost hover:btn-info"
                                    title="View App Details"
                                    wire:click="viewClient('{{ $row['id'] }}')"
                                    icon="o-eye"
                                />
                                <x-mary-button
                                    class="btn-sm btn-ghost hover:btn-warning"
                                    title="Edit App"
                                    wire:click="editClient('{{ $row['id'] }}')"
                                    icon="o-pencil"
                                />
                                @if($row['revoked'] === 'Active')
                                    <x-mary-button
                                        class="btn-sm btn-ghost hover:btn-error"
                                        title="Revoke App"
                                        wire:click="revokeClient('{{ $row['id'] }}')"
                                        icon="o-no-symbol"
                                    />
                                @else
                                    <x-mary-button
                                        class="btn-sm btn-ghost hover:btn-success"
                                        title="Restore App"
                                        wire:click="restoreClient('{{ $row['id'] }}')"
                                        icon="o-arrow-path"
                                    />
                                @endif
                            </div>
                        @endscope
                    </x-mary-table>

                    @if($page > 1 || $hasMorePage)
                        <div class="flex justify-end mt-4 min-h-[40px]">
                            @if($loading)
                                <div class="flex items-center justify-center w-full">
                                    <span class="loading loading-spinner loading-md text-primary"></span>
                                </div>
                            @else
                                <div class="join">
                                    <button class="join-item btn" @if($page == 1) disabled @endif wire:click="goToPage({{ $page - 1 }})">«</button>
                                    <button class="join-item btn btn-active">Page {{ $page }}</button>
                                    <button class="join-item btn" @if(!$hasMorePage) disabled @endif wire:click="goToPage({{ $page + 1 }})">»</button>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

            {{--<x-mary-table :headers="$headers" :rows="$clients"  with-pagination per-page="perPage"
                :per-page-values="[3, 5, 10]" --}} {{-- Notice the `:` bind  />--}}
            </section>
        </div>

        <!-- Sidebar -->
        <livewire:partials.admin.right-sidebar />
    </div>
</div>
