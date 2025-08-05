// Import highlight.js core
// Import highlight.js
import hljs from 'highlight.js/lib/core';
import xml from 'highlight.js/lib/languages/xml'; // includes HTML
import javascript from 'highlight.js/lib/languages/javascript';
import css from 'highlight.js/lib/languages/css';

// Register languages
hljs.registerLanguage('html', xml);
hljs.registerLanguage('xml', xml);
hljs.registerLanguage('javascript', javascript);
hljs.registerLanguage('css', css);

// Make hljs globally available
window.hljs = hljs;

// Initialize highlight.js
function initializeHighlight() {
    if (typeof hljs !== 'undefined') {
        document.querySelectorAll('pre code:not([data-highlighted])').forEach((block) => {
            hljs.highlightElement(block);
        });
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', initializeHighlight);

// Re-initialize on Livewire navigation
document.addEventListener('livewire:navigated', initializeHighlight);

// Re-initialize after Livewire updates
document.addEventListener('livewire:updated', () => {
    setTimeout(initializeHighlight, 100);
});

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

var svgHands = function (element) {
    var
        select = function (e) {
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
        onComplete: function () {
            svg.setActive = false
        }
    });

    timeline.add(tl_lh).add(tl_rh, "-=2");

    timeline.pause().progress();

    return timeline;
}

// Autoplay on page load
// Replace $(document).ready with DOMContentLoaded event
window.addEventListener('DOMContentLoaded', function () {
    if (svg) {
        setTimeout(function () {
            svg.setActive = true;
            var timeline = svgHands();
            timeline.eventCallback("onComplete", function () {
                svg.setActive = false; // Allow mouseenter again
            });
            timeline.play();
        }, 1500); // 2 second delay
    }

    

});

// Replace svg.on('mouseenter', ...) with addEventListener
if (svg) {
    svg.addEventListener('mouseenter', function () {
        if (svg.setActive == false) {
            svg.setActive = true;
            var timeline = svgHands();
            timeline.eventCallback("onComplete", function () {
                svg.setActive = false;
            });
            timeline.play();
        }
        return svg.setActive = true;
    });
}







