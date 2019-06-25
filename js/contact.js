function contact(){
    var mail = document.querySelector("#mailcont");
    var text = document.querySelector("#text");
    var regExMail = /^[a-z0-9-_\.]+[@][a-z0-9-_\.]+\.[a-z]+$/;
    let x = regExMail.test(mail.value);
    let y = text.value !== "";
      if(regExMail.test(mail.value)){
        console.log("OK JE");
        mail.classList.remove("crveno");
      }else {
        mail.classList.add("crveno");
      }
      if (text.value != "") {
        text.classList.remove("crveno");
      }else {
        text.classList.add("crveno");
      }
    console.log(x + y);
    if(x==true && y==true){ return true;}
    if(x==false || y==false){
        return false;
    }
    }