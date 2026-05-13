export function initializeTheme(): void {
  const savedTheme = localStorage.getItem('eduplanner-theme');
  const prefersDark = window.matchMedia?.('(prefers-color-scheme: dark)').matches ?? false;
  const useDark = savedTheme ? savedTheme === 'dark' : prefersDark;

  document.documentElement.classList.toggle('dark', useDark);
}
