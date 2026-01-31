const showRegisterBtn = document.getElementById('showRegister');
  const showLoginBtn = document.getElementById('showLogin');
  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');
  const panelTitle = document.getElementById('panelTitle');
  const panelHeading = document.getElementById('panelHeading');
  const panelText = document.getElementById('panelText');

  showRegisterBtn.addEventListener('click', () => {
    // Animation Login -> Register
    loginForm.classList.add('translate-x-full','opacity-0');
    setTimeout(() => {
      loginForm.classList.add('hidden');
      loginForm.classList.remove('translate-x-full','opacity-0');

      registerForm.classList.remove('hidden');
      registerForm.classList.remove('translate-x-full','opacity-0');
      registerForm.classList.add('opacity-100','translate-x-0');
    }, 300);

    // Update Left Panel
    panelTitle.textContent = 'SupportDesk';
    panelHeading.textContent = 'Rejoignez notre plateforme';
    panelText.textContent = 'Créez votre compte pour centraliser et suivre toutes vos réclamations facilement.';
  });

  showLoginBtn.addEventListener('click', () => {
    // Animation Register -> Login
    registerForm.classList.add('translate-x-full','opacity-0');
    setTimeout(() => {
      registerForm.classList.add('hidden');
      registerForm.classList.remove('translate-x-full','opacity-0');

      loginForm.classList.remove('hidden');
      loginForm.classList.remove('translate-x-full','opacity-0');
      loginForm.classList.add('opacity-100','translate-x-0');
    }, 300);

    // Update Left Panel
    panelTitle.textContent = 'SupportDesk';
    panelHeading.textContent = 'Centralisez la gestion des réclamations et des tickets de support.';
    panelText.textContent = 'Une plateforme professionnelle dédiée à la gestion des réclamations et des tickets de support, assurant un suivi efficace et une communication fluide.';
  });