<div class="admin-ajax-loading">
        <div class="loader"></div>
</div>
<style>
    .admin-ajax-loading {
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
        z-index: 1000000000000000000000000000000000000;
        width: 100%;
        text-align: center;
        display: none;
        align-items: center;
        justify-content: center;
        justify-content: center;
        height: 100%;
        background: #636e72de;
    }.admin-ajax-loading .loader {
         border: 7px solid #7e8f95;
         border-radius: 50%;
         border-top: 7px solid #0984e3;
         width: 110px;
         height: 110px;
         -webkit-animation: spin 2s linear infinite;
         animation: spin 2s linear infinite;
         transform: translate(-50%,-50%);
     }.admin-ajax-loading.active {
          display: flex;
      }/* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
