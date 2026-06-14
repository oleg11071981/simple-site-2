(function() {
  const burger = document.getElementById('burgerBtn');
  const mobileMenu = document.getElementById('mobileMenu');

  if (!burger || !mobileMenu) {
    return;
  }

  burger.addEventListener('click', () => {
    const isActive = mobileMenu.classList.contains('active');
    mobileMenu.classList.toggle('active', !isActive);
    burger.classList.toggle('active', !isActive);
    document.body.style.overflow = isActive ? '' : 'hidden';
  });

  mobileMenu.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', () => {
      mobileMenu.classList.remove('active');
      burger.classList.remove('active');
      document.body.style.overflow = '';
    });
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth > 768 && mobileMenu.classList.contains('active')) {
      mobileMenu.classList.remove('active');
      burger.classList.remove('active');
      document.body.style.overflow = '';
    }
  });
})();
