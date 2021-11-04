/* First search a label */
let label = document.querySelectorAll('label');

/*
Generate a random colors
*/
function rainbowColor() {
    let color = '';
    for(let i = 0; i < 3; i++) {
        let random = Math.floor(Math.random() * 256).toString(16);
        color += (random.length ===  1 ? "0" + random : random);
    }
    return "#" + color;
}

// for each letter
for(let i = 0, letter = label.length; i < letter; ++i) {
    label[i].addEventListener('mouseenter', function () {
        let b = label[i].textContent;
        label[i].innerHTML = '';

        for(let a = 0, letters = b.length; a < letters; ++a) {
            // Create a span
            let span = document.createElement('span');
            span.id = 'resultDancingColor';
            label[i].appendChild(span);
            span.textContent = b[a];
            span.style.color = rainbowColor() ;

        }

    })

}