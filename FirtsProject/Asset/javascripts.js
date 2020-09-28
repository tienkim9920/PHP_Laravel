
function DomID(id){
    return document.getElementById(id)
}

Validation('txtEmail', 'ErrorEmail', 'Email')
Validation('txtTitle', 'ErrorTitle', 'Title')
Validation('txtPrice', 'ErrorPrice', 'Price')


function Validation(idInput, idError, name){
    DomID(idInput).addEventListener('keyup', () => {
        var txtEmail = DomID(idInput).value
        if (txtEmail.length < 4){
            DomID(idError).innerHTML =  name + " Phải Nhiều Hơn 5 Ký Tự!"
        }else{
            DomID(idError).innerHTML = ""
        }
    })
}


var rowProduct = document.querySelectorAll('.rowProduct')

for (var i = 0; i < rowProduct.length; i++){
    let title = rowProduct[i].getElementsByClassName()
}

var arrProduct = []

for (var i = 0; i < rowProduct.length; i++){
    arrProduct.push(rowProduct[i])
}

console.log(arrProduct)

DomID('inputSearch').addEventListener('keyup', () => {
    var inputSearch = DomID('inputSearch').value

    console.log(inputSearch)
})

