'use strict'

{
  var win = document.getElementById("win");
  var lose = document.getElementById("lose");
  var percent = document.getElementsByClassName("percent");
  var select = document.getElementsByClassName("select");
  var reset = document.getElementById("reset");
  var score = document.getElementsByClassName("score");
  var win_per = document.getElementsByClassName("win_per");


  var counter1 = [0,0,0,0,0,0,0];
  var counter2 = [0,0,0,0,0,0,0];
  var winPer = 0;

  function winnerbtn(){
    for (let i = 0 ; i < select.length ; i++){
      select[i].children[0].addEventListener("click", ()=> {
        counter1[i] ++;
        score[i].children[0].textContent = counter1[i];
        winPer = counter1[i] / (counter1[i] + counter2[i]) * 100;
        win_per[i].children[1].textContent = `${winPer.toFixed(2)}%`;
      })
    }
  }

  winnerbtn();

function loserbtn(){
  for (let i = 0 ; i < select.length ; i++){
    select[i].children[1].addEventListener("click", () => {
      counter2[i] += 1;
      score[i].children[2].textContent = counter2[i]
      winPer = counter1[i] / (counter1[i] + counter2[i]) * 100;
      win_per[i].children[1].textContent = `${winPer.toFixed(2)}%`;
    })
  }
}

loserbtn();


function resetbtn(){
  for (let i = 0 ; i < select.length ; i++){
    select[i].children[2].addEventListener("click", () => {
    counter1[i] = 0;
    counter2[i] = 0;
    score[i].children[0].textContent = 0;
    score[i].children[2].textContent = 0;
    win_per[i].children[1].textContent = "0%";
    })
  }
}
resetbtn();

}
