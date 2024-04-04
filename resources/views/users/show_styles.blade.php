<style>
/* ベースのスタイル */
body, html {
    margin: 0;
    padding: 0;
    font-family: 'Arial', sans-serif;
    background: #f9f9f9;
    color: #333;
}

/* ヘッダーのスタイル */
.header-content {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
    background: #ffffff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.header-nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    justify-content: center;
    max-width: 600px;
}

.header-nav li {
    padding: 10px 20px;
    margin: 0 5px;
    cursor: pointer;
    font-size: 0.9em;
    color: #555;
    text-transform: uppercase;
    position: relative;
}

.header-nav li:not(:last-child)::after {
    content: '|';
    position: absolute;
    right: -10px;
    color: #ddd;
}

.header-nav li:hover {
    background-color: #e0e0e0;
    border-radius: 5px;
}

/* "All 一覧"のスタイル */
.all-list {
    text-align: center;
    width: 100%;
    max-width: 600px;
    margin: 20px auto;
    border: 1px solid #ccc;
    padding: 15px;
    background: #ffffff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    font-size: 1.2em;
}

/* コンテンツのスタイル */
.notice-item {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    margin: 15px auto;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    max-width: 600px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    position: relative;
    cursor: pointer;
}

.notice-date {
    font-size: 0.8em;
    color: #999;
    margin-bottom: 5px;
    align-self: flex-start;
}

.notice-category {
    font-size: 0.75em;
    color: #666;
    margin-bottom: 5px;
    align-self: flex-start;
    text-decoration:underline;
}

.notice-description {
    font-size: 0.7em;
    color: #666;
    margin-bottom: 10px;
    align-self: flex-start;
    width:100px;
}

.notice-item img {
    width: 60%; /* 画像の幅を調整 */
    height: auto;
    border: 1px solid #000; /* 画像の境界線 */
    margin: -5px 0; /* 上下のマージン */
}


.notice-title {
    font-size: 1.6em;
    font-weight: bold;
    color: #333;
    width: 100%;
    text-align: center;
    position:absolute;
    text-decoration:underline;

}

.notice-content {
    font-size: 0.85em;
    color: #555;
    width: 100%;
    text-align: center;
    margin-top: 10px;
    padding-top:40px;
    padding-bottom:40px;
}

.notice-more {
    text-align: center;
    padding: 20px;
    font-size: 1em;
    margin-top: 10px;
    display: block;
    background: #f0f0f0;
    color: #333;
    text-decoration: none;
    max-width: 600px;
    margin: 20px auto;
    border: 1px solid #ccc;
    cursor: pointer;
}

.notice-more:hover{
  background: lightgray;
}  

.notice-previous{
    text-align: center;
    padding: 20px;
    font-size: 1em;
    margin-top: 10px;
    display: block;
    background: #f0f0f0;
    color: #333;
    text-decoration: none;
    max-width: 600px;
    margin: 20px auto;
    border: 1px solid #ccc;
    cursor: pointer;
}

.notice-previous:hover{
  background: lightgray;
}

/* レスポンシブスタイルの調整 */
@media (min-width: 768px) {
    .header-nav ul {
        padding: 0 40px;
    }
    .notice-item {
        flex-direction: column;
    }
}

.title-detail {
    display: flex;
    flex-direction: column;
    align-items: flex-start; /* 左寄せにする */
    width: 100%;
    max-width: 600px;
    margin: 20px auto;
    border: 1px solid #ccc;
    padding: 20px;
    background: #ffffff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    font-size: 1.2em;
    margin-bottom: 20px; /* 下にマージンを設ける */
}

.sub{
  font-size:0.6em;
  margin-bottom: 5px;
}

.title {
    align-self: center; /* タイトルを中央に配置 */
    font-size: 1.5em; /* タイトルのフォントサイズを大きく */
    font-weight: bold; /* タイトルを太字に */
    margin-bottom: 30px;
    margin-top:5px

}

.detail-more {
    text-align: center;
    padding: 20px;
    font-size: 1em;
    margin-top: 10px;
    display: block;
    background: #f0f0f0;
    color: #333;
    text-decoration: none;
    max-width: 600px;
    margin: 20px auto;
    border: 1px solid #ccc;
    cursor: pointer;
}

.detail-more:hover{
  background: lightgray;
}  

.detail-previous{
    text-align: center;
    padding: 20px;
    font-size: 1em;
    margin-top: 10px;
    display: block;
    background: #f0f0f0;
    color: #333;
    text-decoration: none;
    max-width: 600px;
    margin: 20px auto;
    border: 1px solid #ccc;
    cursor: pointer;
}

.detail-previous:hover{
  background: lightgray;
}

.content-item {
    background: #ffffff;
    border: 1px solid #e0e0e0;
    margin: 15px auto;
    max-width: 900px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.content img{
  width:100%;
  height:auto;
}

.contact-form-container {
    font-family: 'Arial', sans-serif;
    background-color: #f8f9fa;
    color: #212529;
    padding: 20px;
    max-width: 500px;
    margin: 40px auto;
    border-radius: 8px;
    border: 1px solid ;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 5px;
}

.form-control {
    width: 95%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ced4da;
}

textarea.form-control {
    resize: vertical;
    height: 150px;
}

.btn-submit {
    background-color: #007bff;
    color: #ffffff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
    border-radius: 5px;
    width: 100%;
    transition: background-color 0.3s ease;
}

.btn-submit:hover {
    background-color: #0056b3;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
}

.form-data-container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.close-icon {
    float: right;
    cursor: pointer;
    color:red;
}

.form-data p, .confirmation p {
    margin: 10px 0;
    font-size: 16px;
    color: #333;
}

.form-data span {
    font-weight: bold;
}

.confirmation {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 20px;
}

.confirmation p{
  color:gray;
  font-weight:bold;
}

.confirmation-form {
    display: flex;
    align-items: center;
}

.btn-send {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-send:hover {
    background-color: #0056b3;
}



@media (max-width: 768px) {
    .contact-form-container {
        padding: 15px;
        margin: 20px auto;
    }

    .confirmation {
        flex-direction: column;
    }

    .btn-send {
        width: 100%;
        margin-top: 10px;
    }

}


</style>