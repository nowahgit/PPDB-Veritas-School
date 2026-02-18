document.addEventListener('DOMContentLoaded', function () {

  const btnAdd = document.getElementById('btnAdd')
  const addForm = document.getElementById('addForm')

  if (btnAdd && addForm) {
    btnAdd.addEventListener('click', function () {
      addForm.classList.toggle('hidden')
    })
  }

})
