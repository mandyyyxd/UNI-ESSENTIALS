let topics = [];

function addTopic() {
    const input = document.getElementById('topic-input');
    const username = document.getElementById('username-input').value.trim();
    const topic = input.value.trim();
    const reply = document.getElementById('reply-input').value.trim(); 
    const dateTime = new Date().toLocaleString();
    if (topic !== '' && reply !== '') { 
        topics.push({ title: topic, author: username, dateTime: dateTime, replies: [{ author: username, content: reply }] });
        input.value = '';
        document.getElementById('reply-input').value = '';
        displayTopics();
    } else {
        alert('Please enter both a topic and a response.');
    }
}
function replyToTopic(index) {
    const replyInput = document.getElementById(`reply-input-${index}`);
    const replyContent = replyInput.value.trim();
    
    if (replyContent !== '') {
        const username = document.getElementById('username-input').value.trim();
        const dateTime = new Date().toLocaleString();
        
        topics[index].replies.push({ author: username, content: replyContent, dateTime: dateTime, read: false });
        

        replyInput.value = '';
        

        displayTopics();
    } else {
        alert('Please enter a reply.');
    }
}


function displayTopics() {
    const topicList = document.getElementById('topic-list');
    topicList.innerHTML = '';
    topics.forEach((topic, index) => {
        const topicDiv = document.createElement('div');
        topicDiv.classList.add('topic');

        const newReplies = topic.replies.filter(reply => !reply.read).length > 0;
        if (newReplies) {
            topicDiv.classList.add('new-replies');
        }
        topicDiv.innerHTML = `
        <h2>${topic.title}</h2>
        <p>${topic.replies[0].content}</p> 
        <p><span class= "small">Author: ${topic.author}</span></p>
        <p><span class= "small">Date & Time: ${topic.dateTime}</span></p>
        <input type="text" id="reply-input-${index}" placeholder="Your reply">
        <button onclick="replyToTopic(${index})">Reply</button>
        <button onclick="flagTopic(${index})">Flag</button>
        `;


        topic.replies.slice(1).forEach(reply => {
            const replyDiv = document.createElement('div');
            replyDiv.classList.add('reply');
            replyDiv.innerHTML = `
            <p>${reply.content}</p>
            <p><span class= "small">Author: ${reply.author}</span></p>
            <p><span class= "small">Date & Time: ${reply.dateTime}</span></p>
            `;
            topicDiv.appendChild(replyDiv);
        });

        topicList.appendChild(topicDiv);
    });
}


function flagTopic(index) {

  alert('Topic flagged. Moderators will review it.');
}

function navigateToProductReviews() {
    window.location.href = 'dproductreviews.php';
}

function navigateToStudentLife() {
    window.location.href = 'dstudentlife.php';
}

function navigateToSupport() {
    window.location.href = 'dsupport.php';
}
function goBack() {
    window.history.back();
}