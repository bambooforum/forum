document.getElementById('img').addEventListener('change', function() {
    const preview = document.getElementById('preview');
    const file = this.files[0];

    if(!file) return;

    const reader = new FileReader();
    
    reader.onload = function(e) {
        preview.src = e.target.result;
    };

    reader.readAsDataURL(file);
});
/* 
const file = this.files[0];
Es crea una variable "file" que emmagatzema la primera imatge 
seleccionada pel camp d'entrada de tipus "file" ("this" fa referència a l'element amb l'ID "img"). 
Això permet accedir al fitxer seleccionat per l'usuari.

FileReader, objecte que es fa servir per llegir el contingut del fitxer seleccionat.
*/

/**
 * @type {HTMLButtonElement}
 */
const btn = document.querySelector('form .save button');
for(const element of document.querySelector('form').querySelectorAll('input, textarea')) {
    const oldval = element.value;
    element.addEventListener('input', e => {
        console.log(oldval, e.target.value)
        btn.disabled = e.target.value === oldval;
    });
    element.dispatchEvent(new Event('input'))
}
