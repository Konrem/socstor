// show input for file in main_blocks
const source = document.querySelector('#inputType');
const target = document.querySelector('#image_block');

const displayWhenSelected = (source, value,  target) => {
    const selectedIndex = source.selectedIndex;
    const isSelected = source[selectedIndex].value === value;
    
    target.classList[isSelected ? "add" : "remove"]("show")

};

source.addEventListener("change", (evt) => {
    displayWhenSelected(source,  "1", target);
});
