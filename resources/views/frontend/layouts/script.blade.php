  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('mobile-show');
        }

        function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => section.style.display = 'none');
            
            // Show selected section
            document.getElementById(sectionId).style.display = 'block';
            
            // Update active nav link
            const navLinks = document.querySelectorAll('.sidebar .nav-link');
            navLinks.forEach(link => link.classList.remove('active'));
            event.target.classList.add('active');
            
            // Hide sidebar on mobile after selection
            if (window.innerWidth <= 768) {
                document.getElementById('sidebar').classList.remove('mobile-show');
            }
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            
            if (window.innerWidth <= 768 && 
                !sidebar.contains(event.target) && 
                !menuToggle.contains(event.target)) {
                sidebar.classList.remove('mobile-show');
            }
        });
    </script>