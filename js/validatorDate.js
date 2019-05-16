/**
 * Script que valida os dados no momento de login 
 * @param {formulario} formulario 
 */
function valida_dados(formulario) {
    if (formulario.emailLogin.value == "") {

        document.getElementById("emailLogin").focus();

        var messageEmailElementLogin = document.getElementById("messagemEmailLogin");
        messageEmailElementLogin.innerHTML = "Digite o seu Email.";
        
        return false;
    }
    if (formulario.passwordLogin.value == "") {

        document.getElementById("passwordLogin").focus();

        var messageSenhaElementLogin = document.getElementById("messagemSenhaLogin");
        messageSenhaElementLogin.innerHTML = "Digite sua senha.";

        return false;
    }
    return true;
}

/**
 * Script que valida os dados no momento do cadastro e evita entrada de dados vazios 
 * @param {formulario} formulario 
*/
function valida_dadosCadastro(formulario) {
    if(formulario.name.value == ""){

        document.getElementById("name").focus();

        var messageNomeElement = document.getElementById("messagemNome");
        messageNomeElement.innerHTML = "É obrigatorio digitar um nome.";

        return false;
    }
    if (formulario.password.value == "" || formulario.password.value.length < 4) {

        document.getElementById("password").focus();
        var messageElement = document.getElementById("messagemSenha");
        messageElement.innerHTML = "A senha deve ter no minino 4 caracteres.";

        return false;
    }
    if (formulario.email.value == "") {
        
        document.getElementById("email").focus();

        var messageEmailElement = document.getElementById("messagemEmail");
        messageEmailElement.innerHTML = "O Email é obrigatorio para realizar o cadastro.";

        return false;
    }
    
    return true;
}

/**
 * Verifica os campos de imput na pagina de perfil e retorna true ou false depedendo dos dados
 * @param {*} formulario 
 */
function valida_dadosAlteSenha(formulario) {
    if (formulario.passwordAnt.value == "" || formulario.passwordAnt.value.length < 4) {

        document.getElementById("passwordAnt").focus();
        return false;
    }
    if (formulario.passwordNew.value == "" || formulario.passwordNew.value.length < 4) {

        document.getElementById("passwordNew").focus();
        return false;
    }
    if(formulario.passwordAnt.value == formulario.passwordNew.value){
        
        document.getElementById("passwordNew").focus();
        document.getElementById("passwordAnt").focus();

        M.toast({html: 'A sua nova senha não podem ser igual a atual!'})
        return false;
    }
return true;
}

/**
 * Funcao que deixa o campo de valor apenas recebendo numeros e ja formatando eles
 * @param {*} i 
 */
function moeda(i) {
    var v = i.value.replace(/\D/g, '');
    v = (v / 100).toFixed(2) + '';
    v = v.replace(",", ".");
    v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
    v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
    i.value = v;
}

/**
 * valida os campos de formulario de adicao de receita e despesa
 * @param {*} formulario 
 */
function valida_dadosEntrada(formulario) {

    if (formulario.tituloArea.value == "") {

        document.getElementById("tituloArea").focus();

        return false;
    }
    if (formulario.descricaoArea.value.length > 60) {

        document.getElementById("descricaoArea").focus();

        return false;
    }
    if (formulario.icon_valor.value == "") {

        document.getElementById("icon_valor").focus();

        return false;
    }
    if (formulario.icon_date.value == "") {

        document.getElementById("icon_date").focus();

        var messageDataElement = document.getElementById("dataMessage");
        messageDataElement.innerHTML = "Clique no campo para abrir o calendario.";
        return false;
    }
    return true;
}