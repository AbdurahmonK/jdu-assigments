const textBoxesDiv = document.getElementById('text-boxes');

const textBoxData = [
    { text: 'This is a Sample Text box with background color 02f3e5.', bgColor: '#02f3e5' },
    { text: 'This is a Sample Text box with background color silver.', bgColor: 'silver' },
    { text: 'This is a Sample Text box with background color pink.', bgColor: 'pink' },
    { text: 'This is a Sample Text box with background color red.', bgColor: 'red' },
    { text: 'This is a Sample Text box with background color green with white text.', bgColor: 'green', textColor: 'white' },
    { text: 'This is a Sample Text box with background color purple and white text.', bgColor: 'purple', textColor: 'white' }
];

textBoxData.forEach(data => {
    const textBox = document.createElement('div');
    textBox.classList.add('text-box');
    textBox.textContent = data.text;
    textBox.style.backgroundColor = data.bgColor;
    if (data.textColor) {
        textBox.classList.add('white-text');
    }
    textBoxesDiv.appendChild(textBox);
});