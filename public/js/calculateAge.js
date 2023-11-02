function ageCalculator(){
    var user_input = document.getElementById('birth_date').value;
    var date_of_birth = new Date(user_input);
    
    if(user_input!=null || user_input!='' || user_input!=undefined){
        var month_diff = Date.now() - date_of_birth.getTime();
        var age_df = new Date(month_diff);
        var year = age_df.getUTCFullYear();
        var age = Math.abs(year - 1970);
        return document.getElementById("age").value = age;
    }else{
        return false;
    }
}