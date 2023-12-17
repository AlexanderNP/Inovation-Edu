// Функция для отправки GET-запроса
function getTestResults(userId, questId) {
  fetch(`/api/getResults.php?user_id=${userId}&quest_id=${questId}`)
    .then(response => response.json())
    .then(data => displayResults(data))
    .catch(error => console.error('Ошибка получения результатов:', error));
}

// Функция для отображения результатов теста в поп-апе
function displayResults(results) {
  const testResults = document.getElementById('testResults');
  testResults.innerHTML = `
      <p class="title">${results.name}<span class="diff">${results.diff}</span></p>
      <p class="company">${results.company}</p>
      <p class="dataOpen">Дата открытия теста: ${results.open}</p>
      <ul class="questionList">
        ${results.quest.map(question => {

          let string = `<br><li class="questionItem">Вопрос: ${question.text}</li>`;

          if(question.answer) {
            string += `<li class="questionItem">Ответ: ${question.answer}</li>`;
          }
          if(question.current_answer) {
            string += `<li class="questionItem">Правильный ответ: ${question.current_answer}</li>`;
          }

          return string;
        }).join("")}
      </ul>
      <p class="resultValue">Результат: ${results.result}</p>
      <p class="dataPassing">Дата прохождения: ${results.time}</p>`;
}

//Для соискателя
const testLinks = document.querySelectorAll('.testLink');

testLinks.forEach(link => {
  link.addEventListener('click', function() {
    const userId = this.getAttribute('data-user-id');
    const questId = this.getAttribute('data-quest-id');
    getTestResults(userId, questId);
  });
});

//Для компаний
const resultLinks = document.querySelectorAll('.resultLink');

resultLinks.forEach(link => {
  link.addEventListener('click', function() {
    const userId = this.getAttribute('data-user-id');
    const questId = this.getAttribute('data-quest-id');
    getTestResults(userId, questId);
  });
});

