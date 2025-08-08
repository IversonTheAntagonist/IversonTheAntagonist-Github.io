// script.js
document.addEventListener('DOMContentLoaded', function() {
  const toggle = document.getElementById('modeToggle');
  const body = document.body;
  
  // Check for saved theme preference or use preferred color scheme
  const savedTheme = localStorage.getItem('theme') || 
                    (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
  
  // Apply the saved theme
  if (savedTheme === 'dark') {
    body.classList.add('dark-mode');
    body.classList.remove('light-mode');
    toggle.textContent = '☀️ Light Mode';
  } else {
    body.classList.add('light-mode');
    body.classList.remove('dark-mode');
    toggle.textContent = '🌙 Dark Mode';
  }
  
  // Toggle theme on button click
  toggle.addEventListener('click', () => {
    if (body.classList.contains('dark-mode')) {
      body.classList.remove('dark-mode');
      body.classList.add('light-mode');
      localStorage.setItem('theme', 'light');
      toggle.textContent = '🌙 Dark Mode';
    } else {
      body.classList.remove('light-mode');
      body.classList.add('dark-mode');
      localStorage.setItem('theme', 'dark');
      toggle.textContent = '☀️ Light Mode';
    }
  });
  
  // Add floating particles to background
  createParticles();
  
  // Email validation on form submit
  const forms = document.querySelectorAll('form');
  forms.forEach(form => {
    form.addEventListener('submit', function(e) {
      const emailInput = form.querySelector('input[type="email"]');
      if (emailInput) {
        emailInput.value = emailInput.value.trim().toLowerCase();
      }
    });
  });

  // Auto-close alerts after 5 seconds
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(alert => {
    setTimeout(() => {
      alert.classList.add('fade');
      setTimeout(() => alert.remove(), 150);
    }, 5000);
  });
  
  // Enhance select dropdowns
  const selects = document.querySelectorAll('select');
  selects.forEach(select => {
    select.addEventListener('focus', function() {
      this.style.boxShadow = '0 0 10px var(--neon-blue)';
    });
    select.addEventListener('blur', function() {
      this.style.boxShadow = 'none';
    });
  });
  
  // Credits Modal with name click functionality
  const creditsBtn = document.getElementById('creditsBtn');
  const creditsModal = document.createElement('div');
  creditsModal.className = 'credits-modal';
  creditsModal.innerHTML = `
    <div class="credits-content">
      <span class="credits-close" id="creditsClose">&times;</span>
      <h2 class="jdm-font">STUDENT MANAGEMENT SYSTEM</h2>
      <p>Created by:</p>
      <p class="mb-4">
        <span class="neon-text" id="balighotName">Balighot</span>, 
        <span class="neon-text" id="defeoName">Defeo</span>, 
        <span class="neon-text" id="turayaName">Turaya</span>
      </p>
      <p class="small text-unmuted">© 2025 All Rights Reserved</p>
    </div>
  `;
  document.body.appendChild(creditsModal);

  const creditsClose = document.getElementById('creditsClose');

  creditsBtn.innerHTML = `Created by: <span class="neon-text" id="balighotBtn">Balighot</span>, <span class="neon-text" id="defeoBtn">Defeo</span>, <span class="neon-text" id="turayaBtn">Turaya</span> © 2025`;

  // Function to show message box
  function showMessage(message, color = '#ff1e56') {
    const messageBox = document.createElement('div');
    messageBox.className = 'coder-message-box';
    messageBox.textContent = message;
    messageBox.style.backgroundColor = color;
    messageBox.style.left = `${Math.random() * 50 + 25}%`;
    messageBox.style.top = `${Math.random() * 50 + 25}%`;
    document.body.appendChild(messageBox);
    
    setTimeout(() => {
      messageBox.style.opacity = '0';
      setTimeout(() => messageBox.remove(), 300);
    }, 2000);
  }

  // Add click events for names in modal
  document.getElementById('balighotName')?.addEventListener('click', () => {
    showMessage('The Solo Carry', '#ff1e56');
  });

  document.getElementById('defeoName')?.addEventListener('click', () => {
    showMessage('The Inter', '#170677ff');
  });

  document.getElementById('turayaName')?.addEventListener('click', () => {
    showMessage('AFK', '#9d00ff');
  });

  // Add click events for names in credits button
  document.getElementById('balighotBtn')?.addEventListener('click', (e) => {
    e.stopPropagation();
    showMessage('The Solo Carry', '#ff1e56');
  });

  document.getElementById('defeoBtn')?.addEventListener('click', (e) => {
    e.stopPropagation();
    showMessage('The Inter', '#061f63ff');
  });

  document.getElementById('turayaBtn')?.addEventListener('click', (e) => {
    e.stopPropagation();
    showMessage('AFK', '#9d00ff');
  });

  creditsBtn.addEventListener('click', function() {
    creditsModal.classList.add('active');
    document.body.style.overflow = 'hidden';
  });

  creditsClose.addEventListener('click', function() {
    creditsModal.classList.remove('active');
    document.body.style.overflow = '';
  });

  creditsModal.addEventListener('click', function(e) {
    if (e.target === creditsModal) {
      creditsModal.classList.remove('active');
      document.body.style.overflow = '';
    }
  });

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && creditsModal.classList.contains('active')) {
      creditsModal.classList.remove('active');
      document.body.style.overflow = '';
    }
  });

  // Show glow effect for all names in credits
  const balighotName = document.getElementById('balighotName');
  if (balighotName) {
    balighotName.classList.add('neon-text');
  }

  // Add glow to Defeo and Turaya if they exist
  if (creditsBtn) {
    creditsBtn.innerHTML = `Created by: <span class="neon-text" id="balighotName">Balighot</span>, <span class="neon-text">Defeo</span>, <span class="neon-text">Turaya</span>`;
  }

  if (creditsModal) {
    const modalNames = creditsModal.querySelector('.text-muted');
    if (modalNames) {
      modalNames.innerHTML = `<span class="neon-text">Balighot</span>, <span class="neon-text">Defeo</span>, <span class="neon-text">Turaya</span>`;
    }
  }

  // Create struggling coder icon
  const coderIcon = document.createElement('div');
  coderIcon.className = 'coder-icon';
  coderIcon.innerHTML = `
    <div class="coder">
      <div class="coder-head">
        <div class="coder-eyes">
          <div class="eye"></div>
          <div class="eye"></div>
        </div>
      </div>
      <div class="coder-body"></div>
      <div class="coder-laptop"></div>
      <div class="coder-coffee"></div>
      <div class="coder-thought">KEKW</div>
    </div>
  `;

  // Updated random messages
  const messages = [
    "I'll solo carry this sht",
    "BOMBACLAT",
    "MAMBO",
    "SKIBIDI",
    "Rizzler",
    "1V9",
    "KEKW",
    "Inta",
    "Solo Carry",
    "Rizzler",
    "Skibidi"
  ];

  coderIcon.addEventListener('mouseenter', () => {
    const thought = coderIcon.querySelector('.coder-thought');
    thought.textContent = messages[Math.floor(Math.random() * messages.length)];
  });

  document.body.appendChild(coderIcon);
});

function createParticles() {
  const particlesContainer = document.createElement('div');
  particlesContainer.className = 'particles';
  document.querySelector('.jdm-background').appendChild(particlesContainer);
  
  const particleCount = 50;
  
  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement('div');
    particle.className = 'particle';
    // Random properties
    const size = Math.random() * 5 + 2;
    const posX = Math.random() * 100;
    const posY = Math.random() * 100;
    const delay = Math.random() * 10;
    const duration = Math.random() * 20 + 10;
    const color = `hsl(${Math.random() * 60 + 200}, 100%, 50%)`;
    particle.style.width = `${size}px`;
    particle.style.height = `${size}px`;
    particle.style.left = `${posX}%`;
    particle.style.top = `${posY}%`;
    particle.style.animationDelay = `${delay}s`;
    particle.style.animationDuration = `${duration}s`;
    particle.style.backgroundColor = color;
    particlesContainer.appendChild(particle);
  }
  
  // Add CSS for particles
  const style = document.createElement('style');
  style.textContent = `
    .particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1;
    }
    
    .particle {
      position: absolute;
      border-radius: 50%;
      opacity: 0.6;
      animation: float linear infinite;
    }
    
    @keyframes float {
      0% {
        transform: translateY(0) translateX(0);
        opacity: 0.6;
      }
      50% {
        opacity: 0.9;
      }
      100% {
        transform: translateY(-100vh) translateX(20px);
        opacity: 0;
      }
    }
  `;
  document.head.appendChild(style);
}