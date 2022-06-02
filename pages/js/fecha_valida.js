function hideOrShowPassword() {
  var password1, check;

  password1 = document.getElementById("fecha_creacion");
  check = document.getElementById("ver_creacion");

  if (check.checked == false) // Si la checkbox de mostrar contraseña está activada
  {
    password1.type = "";
  } else // Si no está activada
  {
    password1.type = "datetime-local";
  }
}
function hideOrShowPassword1() {
  var password1, check;

  password1 = document.getElementById("fecha_recibido");
  check = document.getElementById("ver_recibido");

  if (check.checked == false) // Si la checkbox de mostrar contraseña está activada
  {
    password1.type = "";
  } else // Si no está activada
  {
    password1.type = "datetime-local";
  }
}
function hideOrShowPassword2() {
  var password1, check;

  password1 = document.getElementById("fecha_onsite");
  check = document.getElementById("ver_onsite");

  if (check.checked == false) // Si la checkbox de mostrar contraseña está activada
  {
    password1.type = "";
  } else // Si no está activada
  {
    password1.type = "datetime-local";
  }
}
function hideOrShowPassword3() {
  var password1, check;

  password1 = document.getElementById("fecha_repair");
  check = document.getElementById("ver_repair");

  if (check.checked == false) // Si la checkbox de mostrar contraseña está activada
  {
    password1.type = "";
  } else // Si no está activada
  {
    password1.type = "datetime-local";
  }
}
function hideOrShowPassword4() {
  var password1, check;

  password1 = document.getElementById("fecha_cierre");
  check = document.getElementById("ver_cierre");

  if (check.checked == false) // Si la checkbox de mostrar contraseña está activada
  {
    password1.type = "";
  } else // Si no está activada
  {
    password1.type = "datetime-local";
  }
}
