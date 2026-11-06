document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".validate-form").forEach(form => {
    form.addEventListener("submit", event => {
      const phone = form.querySelector('input[name="phone"]');
      const password = form.querySelector('input[name="password"]');
      if (phone && !/^\d{10}$/.test(phone.value.trim())) {
        event.preventDefault(); alert("Please enter a valid 10-digit mobile number."); phone.focus(); return;
      }
      if (password && password.value.length < 6) {
        event.preventDefault(); alert("Password must contain at least 6 characters."); password.focus();
      }
    });
  });
  const search = document.getElementById("transactionSearch");
  if (search) {
    search.addEventListener("input", () => {
      document.querySelectorAll("#transactionsTable tbody tr").forEach(row => {
        row.hidden = !row.textContent.toLowerCase().includes(search.value.toLowerCase());
      });
    });
  }
  const transactionForm = document.getElementById("transactionForm");
  if (transactionForm) {
    transactionForm.addEventListener("submit", event => {
      const amount = Number(transactionForm.querySelector('[name="amount"]').value);
      if (!Number.isFinite(amount) || amount <= 0) {
        event.preventDefault(); alert("Enter an amount greater than zero.");
      }
    });
  }
});