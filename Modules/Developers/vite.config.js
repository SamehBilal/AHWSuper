import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { readdirSync, statSync } from 'fs';
import { join, relative, dirname } from 'path';
import { fileURLToPath } from 'url';

// Get current directory for ES modules
const __filename = fileURLToPath(import.meta.url);
const __dirname = dirname(__filename);

export default defineConfig({
    build: {
        outDir: '../../public/build-developers',
        emptyOutDir: true,
        manifest: 'manifest.json', // <-- changed from true to 'manifest.json'
        cssCodeSplit: true, // Extract CSS to separate files
        assetsDir: 'assets', // Directory for static assets
        rollupOptions: {
            output: {
                assetFileNames: (assetInfo) => {
                    // Organize assets by type
                    if (assetInfo.name?.match(/\.(png|jpe?g|svg|gif|webp)$/)) {
                        return 'assets/images/[name]-[hash][extname]';
                    }
                    if (assetInfo.name?.match(/\.(css)$/)) {
                        return 'assets/css/[name]-[hash][extname]';
                    }
                    return 'assets/[name]-[hash][extname]';
                }
            }
        }
    },
    plugins: [
        laravel({
            publicDirectory: '../../public',
            buildDirectory: 'build-developers',
            input: [
                './resources/assets/js/app.js',
                './resources/assets/css/app.css'
            ],
            refresh: true,
        }),
    ],
});

// Scan all resources for assets file. Return array
function getFilePaths(dir) {
    const filePaths = [];

    function walkDirectory(currentPath) {
        const files = readdirSync(currentPath);
        for (const file of files) {
            const filePath = join(currentPath, file);
            const stats = statSync(filePath);
            if (stats.isFile() && !file.startsWith('.')) {
                const relativePath = 'Modules/Developers/' + relative(__dirname, filePath);
                filePaths.push(relativePath);
            } else if (stats.isDirectory()) {
                walkDirectory(filePath);
            }
        }
    }

    walkDirectory(dir);
    return filePaths;
}

// If you want to use the dynamic file discovery:
// const assetsDir = join(__dirname, 'resources/assets');
// export const paths = getFilePaths(assetsDir);
