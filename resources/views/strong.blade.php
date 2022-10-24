
<style>
h3 {
    margin: 10px;
}
.container {
    font-size: 22px;
    text-align: center;
    margin: 10% 25%;
    padding: 10px;
    border: 1px solid black;
    box-shadow: 0 0 0.3em black;
    border-radius: 20px;
    background-color: #ccc;


}

input {
    width: 500px;
    border-radius: 5px;
    border: none;
    padding: 5px;
    margin: 10px;
}

button {
    background-color: rgb(0, 132, 255);
    color: white;
    font-weight: bold;
    padding: 4px;
    margin: 5px;
    cursor: pointer;
    border-radius: 4px;
    border: 0.3px solid black;
}

#result {
    margin: 20px;
    color: rgb(255, 0, 170)
}

</style>
<div class="container">
    <h3>Saiba se você é forte: </h3> 
    <hr>
    <br>
        <label>Digite seu nome: </label><br>
        <input id="strong" type="text">
        <button id="btnResult" type="button">Ver resultado</button>
    <h4 id="result"></h4>
    <img width=600 id="img" src="">
</div>


<script>
    var resultBtn = document.getElementById("btnResult");
    var strong = document.getElementById("strong");
    var result = document.getElementById("result");
    let img = document.getElementById("img");

    resultBtn.addEventListener('click', strongOrNot);


    function strongOrNot() {
        if(strong.value == "Chrystian" || strong.value == "chrystian" || strong.value == "chrys" || strong.value == "ruan" || strong.value == "ruan inacio" ||  strong.value == "ruan inacio de sousa" || strong.value == "Ruan") {
            result.textContent = "Resultado: Você é muito, muito, muuuuuito FORTEEEEE";
            img.setAttribute("src", "https://i.cdn29.hu/apix_collect_c/1301/dwayne-johnson/dwayne_johnson_screenshot_20200816182624_1_original_1150x645_cover.jpg")

        } else if(strong.value == "Matheus" || strong.value == "matheus") {
            result.textContent = "Resultado: Você é muito, muito, muuuuuito FRAAAAACO HA HA HA 😂😂😂😂😂😂😂"
            img.setAttribute("src","https://pbs.twimg.com/media/FXmBDylX0AA9SXh.jpg");
        } else {
            result.textContent =  "Resultado: Você é fraco";
            img.setAttribute("src","https://pbs.twimg.com/media/FXmBDylX0AA9SXh.jpg");
        }

    }
</script>
