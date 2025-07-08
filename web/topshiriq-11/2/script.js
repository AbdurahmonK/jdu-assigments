const cardContainer = document.getElementById('cardContainer');

document.body.style.fontFamily = 'sans-serif';
document.body.style.display = 'flex';
document.body.style.justifyContent = 'center';
document.body.style.alignItems = 'center';
document.body.style.minHeight = '100vh';
document.body.style.backgroundColor = '#f4f4f4';
document.body.style.margin = '0';

cardContainer.style.display = 'flex';
cardContainer.style.gap = '20px';

const cardData = [
    { title: 'Education', color: '#ffe082' },
    { title: 'Credentialing', color: '#c8e6c9' },
    { title: 'Wallet', color: '#e1bee7' },
    { title: 'Human Resources', color: '#e3f2fd' }
];

cardData.forEach(data => {
    const card = document.createElement('div');
    card.style.width = '150px';
    card.style.height = '180px';
    card.style.backgroundColor = '#fff';
    card.style.borderRadius = '8px';
    card.style.boxShadow = '0 2px 5px rgba(0, 0, 0, 0.1)';
    card.style.display = 'flex';
    card.style.flexDirection = 'column';
    card.style.justifyContent = 'center';
    card.style.alignItems = 'center';
    card.style.textAlign = 'center';
    card.style.cursor = 'pointer';
    card.style.transition = 'background-color 0.3s ease-in-out, transform 0.2s ease-in-out';

    const iconContainer = document.createElement('div');
    iconContainer.style.width = '60px';
    iconContainer.style.height = '60px';
    iconContainer.style.borderRadius = '50%';
    iconContainer.style.display = 'flex';
    iconContainer.style.justifyContent = 'center';
    iconContainer.style.alignItems = 'center';
    iconContainer.style.marginBottom = '10px';
    iconContainer.style.backgroundColor = data.color;

    card.appendChild(iconContainer);

    const cardTitle = document.createElement('div');
    cardTitle.textContent = data.title;
    cardTitle.style.color = '#333';
    cardTitle.style.fontSize = '14px';
    card.appendChild(cardTitle);

    card.addEventListener('mouseover', () => {
        card.style.backgroundColor = data.color;
        card.style.transform = 'translateY(-5px)';
    });

    card.addEventListener('mouseout', () => {
        card.style.backgroundColor = '#fff';
        card.style.transform = 'translateY(0px)';
    });

    cardContainer.appendChild(card);
});