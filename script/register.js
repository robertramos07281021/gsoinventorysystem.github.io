const firstNameVal = document.getElementById("firstname");
const lastNameVal = document.getElementById("lastname");
const add = document.getElementById("increament");






function accountGenerate(){
        document.getElementById("username").value = `gso02${firstNameVal.value.charAt(0)}${lastNameVal.value.charAt(0)}${add.value}`;
}
