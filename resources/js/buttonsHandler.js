let inputs = document.querySelectorAll('input, textarea')
let button = document.querySelector('.form-btn')
let sumbit = document.querySelector('button[type="submit"]')
inputs.forEach( (input) => input.readOnly = !input.readOnly)
sumbit.style.display = 'none'
button.onclick = (e) => {
    inputs.forEach(input => input.readOnly = !input.readOnly)
    if (e.target.innerHTML === 'Edit'){
        e.target.innerHTML = 'Cancel'
        e.target.className = 'cancel-btn'
        sumbit.style.display = 'inline-block'
    }
    else{
        e.target.innerHTML = 'Edit'
        e.target.className = 'form-btn'
        sumbit.style.display = 'none'
    }
}