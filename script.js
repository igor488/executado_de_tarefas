document.getElementById('chat-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const userInput = document.getElementById('user-input').value;
    const actionSelect = document.getElementById('action-select').value;
    const chatBox = document.getElementById('chat-box');

    if (userInput.trim() === '') {
        return;
    }

    const userMessage = document.createElement('div');
    userMessage.textContent = `Você: ${userInput}`;
    chatBox.appendChild(userMessage);

    // Enviar solicitação ao servidor PHP
    fetch('responses.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ message: userInput, action: actionSelect })
    })
    .then(response => response.json())
    .then(data => {
        const botMessage = document.createElement('div');
        botMessage.textContent = `Robozinho: ${data.response}`;
        chatBox.appendChild(botMessage);
    })
    .catch(error => console.error('Erro:', error));

    document.getElementById('user-input').value = '';
});
