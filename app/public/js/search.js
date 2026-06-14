(function() {
  const searchInput = document.getElementById('searchInput');
  const clearBtn = document.getElementById('clearSearch');
  const searchCounter = document.getElementById('searchCounter');
  const docCards = document.querySelectorAll('.doc-card');

  if (!searchInput || !clearBtn || !searchCounter) {
    return;
  }

  function filterDocuments() {
    const searchTerm = searchInput.value.toLowerCase().trim();
    let visibleCount = 0;

    docCards.forEach(card => {
      const title = card.getAttribute('data-title')?.toLowerCase() || '';
      const linkText = card.querySelector('.doc-card-link')?.textContent.toLowerCase() || '';

      if (searchTerm === '' || title.includes(searchTerm) || linkText.includes(searchTerm)) {
        card.style.display = 'flex';
        visibleCount++;
      } else {
        card.style.display = 'none';
      }
    });

    if (searchTerm !== '') {
      clearBtn.style.display = 'flex';
      searchCounter.textContent = visibleCount === 0 ? 'Ничего не найдено' : `Найдено: ${visibleCount}`;
    } else {
      clearBtn.style.display = 'none';
      searchCounter.textContent = '';
    }
  }

  searchInput.addEventListener('input', filterDocuments);
  clearBtn.addEventListener('click', () => {
    searchInput.value = '';
    filterDocuments();
    searchInput.focus();
  });
})();
