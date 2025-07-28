document.addEventListener('DOMContentLoaded', function() {
    const allTextContainers = document.querySelectorAll('.text_news_conteiner');
    const maxChars = 100; // Установим максимальное количество символов на 100

    allTextContainers.forEach(container => {
        const paragraph = container.querySelector('p#news-text-content'); // Убедимся, что выбираем правильный элемент
        const readMoreBtn = container.querySelector('.expand-btn');
        
        // Сохраняем оригинальный текст
        const originalText = paragraph.textContent.trim();
        
        // Пропускаем короткие тексты
        if (originalText.length <= maxChars) {
            readMoreBtn.classList.add('hidden');
            return;
        }
        
        // Находим последний пробел перед 100-м символом
        let lastSpace = originalText.lastIndexOf(' ', maxChars);
        if (lastSpace === -1) lastSpace = maxChars; // если нет пробелов
        
        // Обрезаем текст до последнего пробела
        const shortText = originalText.substring(0, lastSpace) + '...';
        paragraph.textContent = shortText;
        
        // Обработчик для кнопки "читать далее"
        readMoreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            paragraph.textContent = originalText;
            readMoreBtn.classList.add('hidden');
        });
    });
});
