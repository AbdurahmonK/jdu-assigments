const container = document.getElementById('colorTextBoxContainer');

const textBoxData = [
    { text: 'This is a Sample Text box with background color 02f3e5.', bgColor: '#02f3e5' },
    { text: 'This is a Sample Text box with background color silver.', bgColor: 'silver' },
    { text: 'This is a Sample Text box with background color pink.', bgColor: 'pink' },
    { text: 'This is a Sample Text box with background color red.', bgColor: 'red' },
    { text: 'This is a Sample Text box with background color green with white text.', bgColor: 'green', textColor: '#fff' },
    { text: 'This is a Sample Text box with background color purple and white text.', bgColor: 'purple', textColor: '#fff' }
];

document.body.style.fontFamily = 'sans-serif';
document.body.style.display = 'flex';
document.body.style.justifyContent = 'center';
document.body.style.alignItems = 'center';
document.body.style.minHeight = '100vh';
document.body.style.backgroundColor = '#ffff00';
document.body.style.margin = '0';

container.style.display = 'flex';
container.style.flexDirection = 'column';
container.style.gap = '10px';

const title = document.createElement('h1');
title.textContent = 'CSS Color Text Box';
title.style.color = 'red';
title.style.fontSize = '58px';
container.appendChild(title);

const flexDiv = document.createElement('div');
flexDiv.style.display = 'grid';
flexDiv.style.gap = '10px';
flexDiv.style.gridTemplateColumns = 'repeat(2, 1fr)';
container.appendChild(flexDiv);

textBoxData.forEach(item => {
    const textBox = document.createElement('div');
    
    textBox.textContent = item.text;
    textBox.style.backgroundColor = item.bgColor;
    textBox.style.padding = '15px';
    textBox.style.borderRadius = '5px';
    textBox.style.color = item.textColor ? item.textColor : '#333';
    if (item.textColor) {
        container.appendChild(textBox);
    } else {
        flexDiv.appendChild(textBox);
    }
});