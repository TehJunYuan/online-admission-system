function changeInputMethod(){
    const changeInput = document.getElementById('changeInput');
    const ic_section = document.getElementById('ic_section');
    const passport_section = document.getElementById('passport_section');
    const ic1 = document.getElementById('ic1');
    const ic2 = document.getElementById('ic2');
    const ic3 = document.getElementById('ic3');
    const passport = document.getElementById('passport');
    //const nationality = document.getElementById('nationality');
    if(changeInput.checked){
        ic_section.style.display = 'none';
        passport_section.style.display = 'block';
        passport.setAttribute('required','');
        ic1.removeAttribute('required');
        ic2.removeAttribute('required');
        ic3.removeAttribute('required');
        //nationality.value = 161;
    }else{
        ic_section.style.removeProperty('display');
        passport_section.style.display = 'none';
        passport.removeAttribute('required');
        ic1.setAttribute('required','');
        ic2.setAttribute('required','');
        ic3.setAttribute('required','');
        //nationality.value = 131;
    }
}