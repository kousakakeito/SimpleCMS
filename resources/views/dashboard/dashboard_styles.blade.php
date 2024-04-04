<style>
    body, html {
        margin: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
    }
    button {
        background: none;
        border: none;
        cursor: pointer;
        padding: 10px;
        background-color: #007bff; 
        color: white; 
        border-radius: 5px; 
        margin-top:20px;
    }
    button:hover {
        background-color: #0056b3; 
    }
    a{
      color:blue;
      text-decoration:underline;
    }
    #url-container p{
      margin-top:20px;
    }
    .cms-text{
      font-size:50px;
      font-style:bold;
    }
    #cate-link{
        margin: 5px;
        padding: 10px;
        font-size: 16px;
    }
    #notice-link{
        margin: 5px;
        padding: 10px;
        font-size: 16px;
    }
    #contact-link{
        margin-top:40px;
        font-size: 16px;
    }
    .button-group {
        margin-top: 20px;
    }
    .fa-xmark{
        color:red;
        cursor: pointer;
        float:right;
        margin-left: auto;
        
    }
    .fa-xmark2{
      padding-bottom:16px;
    }
    .cate-container {
        display: flex;
        flex-direction: column; 
        align-items: center; 
        width: 100%; 
        max-width: 400px; 
        margin: auto; 
        padding: 20px;
        background-color:white;
        border-style:solid;
        border-color:black;
        border-width:1px;
        min-height: 500px; 
    }
    #category-btn {
        width: 100%; 
        margin-bottom: 20px; 
    }
    .cate-content {
        width: 100%; 
        flex-grow: 1; 
        background-color: #f5f5f5; 
        padding: 20px;
        background-color:white;
        border-style:solid;
        border-color:black;
        border-width:1px;
        min-height: 300px; 
    }
    .cate-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        max-width: 400px;
        margin: auto;
        padding: 20px;
        background-color: white;
        border: 1px solid black;
        min-height: 300px;
    }
    .submit-btn{
        background-color: #007bff; 
    }
    .category-input, .category-textarea, .submit-btn {
        width: 100%;
        margin-bottom: 20px;
    }
    .category-textarea {
        height: 100px;
    }
    .notice-container {
        width: 100%;
        max-width: 1000px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color:white;
        border-style:solid;
        border-color:black;
        border-width:1px;
    }
    #notice-btn {
        width: 100%; 
        margin-bottom: 20px; 
    }
    .notice-content {
        width: 100%; 
        flex-grow: 1; 
        background-color: #f5f5f5; 
        padding: 20px;
        background-color:white;
        border-style:solid;
        border-color:black;
        border-width:1px;
        min-height: 300px; 
    }
    .notice-group {
        margin-bottom: 15px;
    }
    label {
        display: block;
        float:left;
        margin-bottom: 5px;
    }
    input[type="text"],
    input[type="date"],
    input[type="file"],
    select,
    textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .ck-editor__editable_inline {
        min-height: 600px; 
    }
    .notice-group button[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        margin-left:auto;
        justify-content:center;
        width: 50%; 
    }
    button[type="submit"]:hover {
        background-color: #0056b3;
    }
    .search-form {
        display: flex; 
        position: relative;
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .search-form input[type="text"] {
        flex-grow: 1;
        padding-right: 80px; 
    }
    .search-btn {
        position: absolute; 
        right: 0; 
        top: 0; 
        margin: 0; 
        height: 100%; 
        background-color: #007bff; 
    }
    .category-item {
        display: flex;
        justify-content: space-between; 
        align-items: center;
        width: 100%; 
    }
    .category-name {
        flex-grow: 1; 
    }
    .category-buttons {
        margin-top:-20px;
        padding:10px;
    }
    .notice-item {
        display: flex;
        justify-content: space-between; 
        align-items: center;
        width: 100%; 
    }
    .notice-name {
        flex-grow: 1; 
    }
    .notice-buttons {
        margin-top:-20px;
        padding:10px;
    }
    .delete-container,
    .change-container{
        position: fixed; 
        z-index: 1; 
        left: 0;
        top: 0;
        width: 100%; 
        height: 100%; 
        overflow: auto; 
        background-color: rgb(0,0,0); 
        background-color: rgba(0,0,0,0.4); 
    }

    .delete-modal-content,
    .change-modal-content{
        background-color: #fefefe;
        margin: 15% auto; 
        padding: 20px;
        border: 1px solid #888;
        width: 100%;
        max-width: 600px;
        min-height:170px;
        font-weight:bold;
        letter-spacing:2px;
        border-radius:20px;
    }
    .cate-changebtn{
      padding-top:2px;
      padding-bottom:2px;
      margin-bottom:40px;
    }
    .category-list{
      padding-top:20px;
      cursor:grab;
    }
    .category-list:active{
      cursor:grabbing;
    }
    
    .ck-content .image {
      max-width: 80%;
      margin: 20px auto;
    }

    .contacts-container {
    margin: 20px;
    padding: 10px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0,0,0,0.15);
    border-radius: 8px;
}

.contact-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

.contact-item:last-child {
    border-bottom: none;
}

.contact-info {
    display: flex;
    align-items: center;
}

.contact-date, .contact-name, .contact-subject {
    margin-right: 20px;
    white-space: nowrap;
}

.contact-date {
    color: #666;
    font-size: 0.85em;
}

.contact-name {
    font-weight: bold;
    color: #333;
}

.contact-subject {
    color: #333;
    flex-grow: 1;
}

.btn-delete {
    
    background-color: #ff4d4d;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 6px 12px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.btn-delete:hover {
    background-color: #ff3333;
}
.contact-cancel{
    position:absolute;
    right:30px;
    padding-top:12px;
}

.contact-detail-container {
    margin-top: 20px;
}

.contact-email, .contact-message {
    margin-bottom: 15px;
    font-size: 16px;
    line-height: 1.5;
}

.contact-email span, .contact-message span {
    font-weight: 600;
}

.no-contact {
    text-align: center;
    font-size: 18px;
    color: #333;
}

@media (max-width: 768px) {
    .contact-info {
        flex-direction: column;
        align-items: flex-start;
    }

    .contact-date, .contact-name, .contact-subject {
        margin-right: 0;
        margin-bottom: 5px;
    }

    .contact-email, .contact-message {
        font-size: 14px;
    }
}

</style>