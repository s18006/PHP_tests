const logout = () => {
  if (confirm('本当にログアウトしたいですか')) {
    window.location.href = 'login.php?logout="1"';
  }
}
