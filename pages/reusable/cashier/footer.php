<style>
.main-footer {
  background-color: #2a273c;
  color: #d6d9db;
  padding: 10px;
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 1000;

  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: margin-left 0.3s ease;
}

/* Match AdminLTE sidebar width when expanded */
.sidebar-open .main-footer,
.layout-fixed.sidebar-mini .main-footer {
  margin-left: 250px; /* Default AdminLTE expanded sidebar width */
}

/* Match AdminLTE sidebar width when collapsed */
.sidebar-collapse .main-footer {
  margin-left: 80px; /* Default collapsed sidebar width */
}

body {
  margin: 0;
  padding-bottom: 50px; /* Matches footer height */
}

</style>

<footer class="main-footer">
  <strong>Copyright &copy; 2025. Developed by:dessa</strong>
  <div><b>Version</b> 1.0.0</div>
</footer>