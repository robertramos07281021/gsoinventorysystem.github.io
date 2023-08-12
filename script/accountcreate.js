document.getElementById("saveForm").style.display = "none" ;

function editForm(){
    document.getElementById("saveForm").style.display = "flex" ;
    document.getElementById("editButton").style.display = "none";

}

function cancelButton(){
    document.getElementById("saveForm").style.display = "none" ;
    document.getElementById("editButton").style.display = "flex";
}
