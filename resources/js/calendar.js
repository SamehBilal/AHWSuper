

window.addEventListener('DOMContentLoaded', function () {
    // CHECK LEAP YEAR
    function isLeapYear(year) {
        return (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) || (year % 100 === 0 && year % 400 === 0);
    }

    function getFebDays(year) {
        return isLeapYear(year) ? 29 : 28;
    }

    const month_names = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    // Initialize calendar when DOM is loaded or when navigating between pages
    function initCalendar() {
        const calendar = document.querySelector('.calendar');
        if (!calendar) return;

        const month_picker = document.getElementById('month-picker');
        if (!month_picker) return;

        const month_list = calendar.querySelector('.month-list');
        if (!month_list) return;

        // Clear existing event listeners and children to prevent duplicates
        month_list.innerHTML = '';

        // Set up month picker click event
        month_picker.onclick = () => {
            month_list.classList.add('show');
        };

        // GENERATE CALENDAR function
        function generateCalendar(month, year) {
            const calendar_days = document.querySelector('.calendar-days');
            if (!calendar_days) return;

            calendar_days.innerHTML = '';
            const calendar_header_year = document.getElementById('year');
            if (!calendar_header_year) return;

            const days_of_month = [31, getFebDays(year), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
            const currDate = new Date();

            month_picker.innerHTML = month_names[month];
            calendar_header_year.innerHTML = year;

            const first_day = new Date(year, month, 1);

            for (let i = 0; i <= days_of_month[month] + first_day.getDay() - 1; i++) {
                let day = document.createElement('div');
                if (i >= first_day.getDay()) {
                    day.innerHTML = i - first_day.getDay() + 1;
                    day.innerHTML += `<span></span>
                                  <span></span>
                                  <span></span>
                                  <span></span>`;

                    if (i - first_day.getDay() + 1 === currDate.getDate() && year === currDate.getFullYear() && month === currDate.getMonth()) {
                        day.classList.add('curr-date');
                    }
                }
                calendar_days.appendChild(day);
            }
        }

        // Set up month list
        month_names.forEach((e, index) => {
            let month = document.createElement('div');
            month.innerHTML = `<div>${(e)}</div>`;
            month.onclick = () => {
                month_list.classList.remove('show');
                curr_month.value = index;
                generateCalendar(curr_month.value, curr_year.value);
            };
            month_list.appendChild(month);
        });

        // Set up year navigation
        const prev_year = document.querySelector('#prev-year');
        const next_year = document.querySelector('#next-year');

        if (prev_year) {
            prev_year.onclick = () => {
                --curr_year.value;
                generateCalendar(curr_month.value, curr_year.value);
            };
        }

        if (next_year) {
            next_year.onclick = () => {
                ++curr_year.value;
                generateCalendar(curr_month.value, curr_year.value);
            };
        }

        // Initialize with current date
        const currDate = new Date();
        const curr_month = { value: currDate.getMonth() };
        const curr_year = { value: currDate.getFullYear() };

        // Generate the initial calendar
        generateCalendar(curr_month.value, curr_year.value);
    }

    // Initialize calendar on page load
    document.addEventListener('DOMContentLoaded', initCalendar);

    // Initialize calendar when Livewire updates the DOM
    document.addEventListener('livewire:navigated', initCalendar);
    document.addEventListener('livewire:load', initCalendar);

    // Additional Livewire 3 specific events
    document.addEventListener('livewire:initialized', initCalendar);
    document.addEventListener('livewire:navigating', () => {
        // Add a small delay to ensure the calendar is initialized after navigation
        setTimeout(initCalendar, 100);
    });

    // Fallback for any missed initializations
    setTimeout(initCalendar, 500);

    // Use MutationObserver to detect when calendar is added to the DOM
    const observer = new MutationObserver((mutations) => {
        mutations.forEach((mutation) => {
            if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                // Check if any of the added nodes is the calendar or contains the calendar
                mutation.addedNodes.forEach((node) => {
                    if (node.nodeType === 1) { // Element node
                        if (node.classList && node.classList.contains('calendar') ||
                            node.querySelector && node.querySelector('.calendar')) {
                            initCalendar();
                        }
                    }
                });
            }
        });
    });

    // Start observing the document body for DOM changes
    observer.observe(document.body, { childList: true, subtree: true });


});
