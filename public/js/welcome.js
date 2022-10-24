/*  
var buy = document.querySelector(".buy");
var btnBuy = document.querySelector(".btnBuy");
buy.addEventListener("click", buyOrRemove);

function buyOrRemove() {

    if(buy.getAttribute("class") === "buy") {
           
            
            btnBuy.setAttribute("class", "btnWait");
            buy.setAttribute("class", "wait");
            btnBuy.textContent = "Adicionando...";
                setTimeout(() => {
                    btnBuy.setAttribute("class", "btnAdded");
                    buy.setAttribute("class", "added");
                    btnBuy.setAttribute("type", "disabled");
                    btnBuy.textContent = "Adicionado ao carrinho";
            
            
            
            
                }, 1000);

        
    }

}
*/