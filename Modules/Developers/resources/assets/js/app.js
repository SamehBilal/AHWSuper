

// Add hover effects to decorative elements
document.querySelectorAll('.organic-shape').forEach(shape => {
    shape.addEventListener('mouseenter', () => {
        shape.style.transform += ' scale(1.05)';
        shape.style.transition = 'transform 0.3s ease';
    });

    shape.addEventListener('mouseleave', () => {
        shape.style.transform = shape.style.transform.replace(' scale(1.05)', '');
    });
});

// Replace jQuery selector with vanilla JS
var svg = document.getElementById('hands-svg');
if (svg) {
    svg.setActive = false;
}

var svgHands = function(element) {
    var
        select = function(e) {
            return document.querySelector(e);
        },
        hands = select('#hands'),
        left_hand = select('#left_hand'),
        right_hand = select('#right_hand'),
        left_index_finger = select("#left_index_finger"),
        left_middle_finger = select("#left_middle_finger"),
        left_ring_finger = select("#left_ring_finger"),
        right_index_finger = select("#right_index_finger"),
        right_middle_finger = select("#right_middle_finger"),
        right_ring_finger = select("#right_ring_finger");

    var tl_lh = new TimelineLite();
    tl_lh
        .add(
            TweenMax.set(
                [left_index_finger, left_middle_finger, left_ring_finger], {
                    transformOrigin: "50% 100%"
                }),
            TweenMax.set(
                left_hand, {
                    transformOrigin: "50% 100%",
                    x: 0,
                    y: 0
                })
        )
        .add(TweenMax.to(left_hand, 0.5, {
            y: -10
        }, 0))
        .add(TweenMax.to(left_index_finger, 0.15, {
            scaleY: 0.8
        }))
        .add(TweenMax.to(left_index_finger, 0.15, {
            scaleY: 1
        }))
        .add(TweenMax.to(left_hand, 0.2, {
            y: -20,
            x: -10
        }))
        .add(TweenMax.to(left_middle_finger, 0.15, {
            scaleY: 0.8
        }))
        .add(TweenMax.to(left_middle_finger, 0.15, {
            scaleY: 1
        }))
        .add(TweenMax.to(left_hand, 0.1, {
            y: -24,
            x: 24
        }))
        .add(TweenMax.to(left_middle_finger, 0.15, {
            scaleY: 0.8
        }))
        .add(TweenMax.to(left_middle_finger, 0.15, {
            scaleY: 1
        }))
        .add(TweenMax.to(left_ring_finger, 0.15, {
            scaleY: 0.8
        }))
        .add(TweenMax.to(left_ring_finger, 0.15, {
            scaleY: 1
        }))
        .add(TweenMax.to(left_hand, 0.5, {
            x: 0,
            y: 0
        }, 0));

    var tl_rh = new TimelineLite();

    tl_rh
        .add(
            TweenMax.set(
                [right_index_finger, right_middle_finger, right_ring_finger], {
                    transformOrigin: "50% 100%"
                }),
            TweenMax.set(
                right_hand, {
                    transformOrigin: "50% 100%",
                    x: 0,
                    y: 0
                })
        )
        .add(TweenMax.to(right_hand, 0.5, {
            y: -10
        }, 0))
        .add(TweenMax.to(right_index_finger, 0.15, {
            scaleY: 0.8
        }))
        .add(TweenMax.to(right_index_finger, 0.15, {
            scaleY: 1
        }))
        .add(TweenMax.to(right_hand, 0.2, {
            y: -20,
            x: -10
        }))
        .add(TweenMax.to(right_middle_finger, 0.15, {
            scaleY: 0.8
        }))
        .add(TweenMax.to(right_middle_finger, 0.15, {
            scaleY: 1
        }))
        .add(TweenMax.to(right_hand, 0.1, {
            y: -24,
            x: 12
        }))
        .add(TweenMax.to(right_middle_finger, 0.15, {
            scaleY: 0.8
        }))
        .add(TweenMax.to(right_middle_finger, 0.15, {
            scaleY: 1
        }))
        .add(TweenMax.to(right_ring_finger, 0.15, {
            scaleY: 0.8
        }))
        .add(TweenMax.to(right_ring_finger, 0.15, {
            scaleY: 1
        }))
        .add(TweenMax.to(right_hand, 0.5, {
            x: 0,
            y: 0
        }, 0));

    var timeline = new TimelineLite({
        onComplete: function() {
            svg.setActive = false
        }
    });

    timeline.add(tl_lh).add(tl_rh, "-=2");

    timeline.pause().progress();

    return timeline;
}

// Autoplay on page load
// Replace $(document).ready with DOMContentLoaded event
window.addEventListener('DOMContentLoaded', function() {
    if (svg) {
        setTimeout(function() {
            svg.setActive = true;
            var timeline = svgHands();
            timeline.eventCallback("onComplete", function() {
                svg.setActive = false; // Allow mouseenter again
            });
            timeline.play();
        }, 1500); // 2 second delay
    }
});

// Replace svg.on('mouseenter', ...) with addEventListener
if (svg) {
    svg.addEventListener('mouseenter', function() {
        if (svg.setActive == false) {
            svg.setActive = true;
            var timeline = svgHands();
            timeline.eventCallback("onComplete", function() {
                svg.setActive = false;
            });
            timeline.play();
        }
        return svg.setActive = true;
    });
}

// CHECK LEAP YEAR
function isLeapYear(year) {
    return (year % 4 === 0 && year % 100 !== 0 && year % 400 !== 0) || (year % 100 === 0 && year % 400 === 0 );
}

function getFebDays(year) {
    return isLeapYear(year) ? 29 : 28;
}

const calendar = document.querySelector('.calendar');

const month_names = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

const month_picker = document.getElementById('month-picker');

month_picker.onclick = () => {
    month_list.classList.add('show');
}

// GENERATE CALENDAR
function generateCalendar(month, year) {
    let calendar_days = document.querySelector('.calendar-days');
    calendar_days.innerHTML='';
    let calendar_header_year = document.getElementById('year');
    let days_of_month = [31, getFebDays(year),31,30,31,30,31,31,30,31,30,31];

    let currDate = new Date();

    month_picker.innerHTML = month_names[month];
    calendar_header_year.innerHTML = year;

    let first_day = new Date(month, year, 1);

    for(let i = 0; i <= days_of_month[month] + first_day.getDay() -1 ; i++){
        let day = document.createElement('div');
        if( i >= first_day.getDay()){
            day.innerHTML = i - first_day.getDay() + 1;
            day.innerHTML += `<span></span>
                              <span></span>
                              <span></span>
                              <span></span>`;

            if(i - first_day.getDay() + 1 === currDate.getDate() && year === currDate.getFullYear() && month === currDate.getMonth()){
                day.classList.add('curr-date');
            }
        }
        calendar_days.appendChild(day);
    }
}

let month_list = calendar.querySelector('.month-list');
month_names.forEach((e, index) => {
    let month = document.createElement('div');
    month.innerHTML = `<div>${(e)}</div>`;
    month.onclick = () =>{
        month_list.classList.remove('show');
        curr_month.value = index;
        generateCalendar(curr_month.value, curr_year.value);

    }
    month_list.appendChild(month);
});

document.querySelector('#prev-year').onclick = () => {
    --curr_year.value;
    generateCalendar(curr_month.value, curr_year.value);
}

document.querySelector('#next-year').onclick = () => {
    ++curr_year.value;
    generateCalendar(curr_month.value, curr_year.value);
}

let currDate = new Date();
let curr_month = {value: currDate.getMonth()};
let curr_year = {value: currDate.getFullYear()};

generateCalendar(curr_month.value, curr_year.value);

