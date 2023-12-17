let questionCount = 0;
let optionCount = 0;

function addQuestion(type) {
  if (questionCount >= 20) {
    alert('Достигнут лимит вопросов!');
    return;
  }

  questionCount++;

  const container = document.getElementById('questionsContainer');

  // Создаем контейнер для вопроса
  const questionContainer = document.createElement('div');
  container.appendChild(questionContainer);

  // Создаем лейбл для вопроса
  const questionLabel = document.createElement('label');
  questionLabel.className = 'constructLabel';
  questionLabel.textContent = `Вопрос ${questionCount} (${type === 'open' ? 'Открытый' : 'С вариантами'})`;
  questionContainer.appendChild(questionLabel);

  // Создаем инпут для вопроса
  const questionInput = document.createElement('input');
  questionInput.type = 'text';
  questionInput.name = `quest_${questionCount}`;
  questionInput.className = 'constructInput';
  questionContainer.appendChild(questionInput);

  // Добавляем кнопку удаления
  const deleteBtn = document.createElement('button');
  deleteBtn.textContent = 'Удалить';
  deleteBtn.className = 'deleteBtn';
  deleteBtn.onclick = function () {
    container.removeChild(questionContainer);
    questionCount--;
    updateQuestionNumberAfterRemove()
    formBtn()
  };
  questionContainer.appendChild(deleteBtn);

  const optionsContainer = document.createElement('div');
  questionContainer.appendChild(optionsContainer);

  if (type === 'multipleChoice') {
    for (let i = 0; i < 5; i++) {

      optionCount++;

      // Создаем контейнер для варианта ответа
      const optionContainer = document.createElement('div');
      optionsContainer.appendChild(optionContainer);

      // Создаем лейбл для варианта ответа
      const optionLabel = document.createElement('label');
      optionLabel.className = 'constructLabel indent';
      optionLabel.textContent = i === 0 ? 'Правильный ответ' : `${i} вариант`;
      optionContainer.appendChild(optionLabel);

      // Создаем инпут для варианта ответа
      const optionInput = document.createElement('input');
      optionInput.type = 'text';
      optionInput.name = `quest_${questionCount}_${i === 0 ? 'correct' : i}`;
      optionInput.className = 'constructInput indent';
      optionContainer.appendChild(optionInput);

      // Добавляем кнопку удаления (если не основные инпуты)
      if (i > 0) {
        const deleteOptionBtn = document.createElement('button');
        deleteOptionBtn.textContent = 'Удалить';
        deleteOptionBtn.className = 'deleteBtn';
        deleteOptionBtn.onclick = function () {
          optionsContainer.removeChild(optionContainer);
          optionCount--;
        };
        optionContainer.appendChild(deleteOptionBtn);
      }
    }
  }

  formBtn()
}


function updateQuestionNumberAfterRemove() {
  const container = document.getElementById('questionsContainer');
  const questionContainers = container.children;

  for (let i = 0; i < questionContainers.length; i++) {
    const questionLabel = questionContainers[i].querySelector('.constructLabel');
    const questionInput = questionContainers[i].querySelector('.constructInput');
    
    if (questionLabel) {
      const questionType = questionLabel.textContent.includes('Открытый') ? 'Открытый' : 'С вариантами';
      questionLabel.textContent = `Вопрос ${i + 1} (${questionType})`;
    }

    if (questionInput) {
      questionInput.name = `quest_${i + 1}`;
    }
  }
}

function formBtn() {
  if (questionCount < 2) {
    document.getElementById('submitBtn').classList.add('hidden');
  } else {
    document.getElementById('submitBtn').classList.remove('hidden');
  }
}
