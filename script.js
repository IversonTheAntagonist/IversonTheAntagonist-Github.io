// 3D Background Animation
function init3DBackground() {
  const canvas = document.createElement('canvas');
  const container = document.createElement('div');
  container.className = 'canvas-container';
  container.appendChild(canvas);
  document.body.insertBefore(container, document.body.firstChild);

  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  const ctx = canvas.getContext('2d');

  // Particles configuration
  const particles = [];
  const particleCount = window.innerWidth < 768 ? 30 : 80;
  const colors = ['#8a6e4b', '#b89f7b', '#6b5638', '#e8e0d0', '#3a3226'];

  // Create particles
  for (let i = 0; i < particleCount; i++) {
    particles.push({
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height,
      size: Math.random() * 5 + 1,
      speedX: Math.random() * 0.5 - 0.25,
      speedY: Math.random() * 0.5 - 0.25,
      color: colors[Math.floor(Math.random() * colors.length)],
      angle: Math.random() * Math.PI * 2,
      angleSpeed: Math.random() * 0.02 - 0.01,
      z: Math.random() * 5,
    });
  }

  // Animation loop
  function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Update and draw particles
    particles.forEach(p => {
      // Update particle position
      p.x += p.speedX;
      p.y += p.speedY;
      p.angle += p.angleSpeed;
      
      // Wrap around screen edges
      if (p.x > canvas.width + p.size) p.x = -p.size;
      if (p.x < -p.size) p.x = canvas.width + p.size;
      if (p.y > canvas.height + p.size) p.y = -p.size;
      if (p.y < -p.size) p.y = canvas.height + p.size;
      
      // Draw particle with 3D effect
      const scale = 1 + p.z * 0.1;
      ctx.save();
      ctx.translate(p.x, p.y);
      ctx.rotate(p.angle);
      ctx.scale(scale, scale);
      
      ctx.beginPath();
      ctx.arc(0, 0, p.size, 0, Math.PI * 2);
      ctx.fillStyle = p.color;
      ctx.fill();
      
      // Add subtle highlight for 3D effect
      ctx.beginPath();
      ctx.arc(-p.size/3, -p.size/3, p.size/3, 0, Math.PI * 2);
      ctx.fillStyle = 'rgba(255, 255, 255, 0.2)';
      ctx.fill();
      
      ctx.restore();
    });
    
    requestAnimationFrame(animate);
  }
  
  animate();

  // Handle window resize
  window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  });
}

// Enhanced form show animation with particles
function showForm(formId) {
  // Create particle burst effect
  createParticleBurst();
  
  document.querySelectorAll(".form-box").forEach(form => {
    form.classList.remove("active");
    form.style.opacity = "0";
    form.style.transform = "rotateY(20deg) translateZ(-50px)";
  });
  
  const activeForm = document.getElementById(formId);
  activeForm.classList.add("active");
  setTimeout(() => {
    activeForm.style.opacity = "1";
    activeForm.style.transform = "rotateY(0deg) translateZ(0)";
  }, 10);
}

// Particle burst effect
function createParticleBurst() {
  const colors = ['#8a6e4b', '#b89f7b', '#6b5638'];
  const particleCount = 15;
  
  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement('div');
    particle.className = 'particle';
    particle.style.width = `${Math.random() * 10 + 5}px`;
    particle.style.height = particle.style.width;
    particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
    particle.style.left = `${Math.random() * 100}vw`;
    particle.style.bottom = '0';
    particle.style.animationDuration = `${Math.random() * 3 + 2}s`;
    particle.style.animationDelay = `${Math.random() * 0.5}s`;
    
    document.body.appendChild(particle);
    
    // Remove particle after animation
    setTimeout(() => {
      particle.remove();
    }, 4000);
  }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
  init3DBackground();
  
  // Theme toggle
  const themeToggle = document.createElement('button');
  themeToggle.className = 'theme-toggle';
  themeToggle.innerHTML = '🌓';
  themeToggle.addEventListener('click', toggleTheme);
  document.body.appendChild(themeToggle);
  
  // Check for saved theme preference
  const savedTheme = localStorage.getItem('theme') || 'light';
  document.documentElement.setAttribute('data-theme', savedTheme);
  
  // Animate active form on load
  setTimeout(() => {
    const activeForm = document.querySelector('.form-box.active');
    if (activeForm) {
      activeForm.style.opacity = "1";
      activeForm.style.transform = "rotateY(0deg) translateZ(0)";
    }
  }, 500);
});

function toggleTheme() {
  const currentTheme = document.documentElement.getAttribute('data-theme');
  const newTheme = currentTheme === 'light' ? 'dark' : 'light';
  
  document.documentElement.setAttribute('data-theme', newTheme);
  localStorage.setItem('theme', newTheme);
  
  // Add animation to toggle button
  const themeToggle = document.querySelector('.theme-toggle');
  themeToggle.style.transform = 'rotate(180deg) scale(1.1)';
  setTimeout(() => {
    themeToggle.style.transform = 'rotate(0deg) scale(1)';
  }, 300);
}