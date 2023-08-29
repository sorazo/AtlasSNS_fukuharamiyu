// アコーディオンメニューの設定

const qa = document.querySelector(".js-ac"); // js-ac要素を取得し変数に格納

function acToggle() { // クリック時に実行される関数を作成
  const content = this.nextElementSibling; // js-ac要素の「次の要素」を取得し変数に格納
  content.classList.toggle("is-open"); // js-ac要素の「次の要素」
  const qa = this; // js-ac要素自身を変数に格納
  qa.classList.toggle('is-open'); // js-ac要素にis-openつけ外し
}

qa.addEventListener("click", acToggle);// クリックイベントを登録、acToggle関数を発火
