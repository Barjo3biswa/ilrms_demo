<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Untitled Document</title>
  <style>
      .loader-wrap {
          position: fixed;
          z-index: 9999;
          height: 100%;
          width: 100%;
          overflow: show;
          margin: auto;
          background-color: #152016;
          top: 0;
          left: 0;
          bottom: 0;
          right: 0;
          display: flex;
          justify-content: center;
          align-items: center;
      }

      .loader-container {
          display: flex;
          flex-direction: column;
          align-items: center;
      }

      .loader-text {
          margin-top: 10px; /* Adjust as needed */
          font-size: 16px; /* Adjust as needed */
          font-weight: normal; /* Adjust as needed */
          color: #000000; /* Adjust as needed */
      }

      .dots {
          display: inline-block;
          animation: blink 0.5s infinite steps(5, start);
      }

      @keyframes blink {
          to {
              visibility: hidden;
          }
      }

      .loader {
          transform: translateZ(1px);
          width: 60px; /* Match the width and height of :after pseudo-element */
          height: 60px; /* Match the width and height of :after pseudo-element */
          border-radius: 50%;
          display: inline-block;
          position: relative;
      }

      .loader:after {
          content: '₹';
          display: inline-block;
          width: 60px;
          height: 60px;
          border-radius: 50%;
          text-align: center;
          line-height: 50px;
          font-size: 50px;
          font-weight: bold;
          background: #50ff00;
          color: #000000;
          border: 4px double;
          box-sizing: border-box;
          box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, .1);
          animation: coin-flip 10s cubic-bezier(0, 0.2, 0.8, 1) infinite;
      }

      @keyframes coin-flip {
          0%, 100% {
              animation-timing-function: cubic-bezier(0.5, 0, 1, 0.5);
          }
          0% {
              transform: rotateY(0deg);
          }
          50% {
              transform: rotateY(1800deg);
              animation-timing-function: cubic-bezier(0, 0.5, 0.5, 1);
          }
          100% {
              transform: rotateY(3600deg);
          }
      }
  </style>
</head>
<div id="includedContent_header"></div>
<main class="rtps-container">
    <div class="loader-wrap">
      <div class="loader-container">
          <span class="loader"></span>
          <div class="loader-text text-white font-weight-bolder">Loading<span class="dots text-white font-weight-bolder h4">...</span></div>
      </div>
    </div>
    <form action="<?=$action?>" name="frmgr" id="frmgr" method="post">
        <input type="hidden" id="DEPARTMENT_ID" name="DEPARTMENT_ID" value="<?=$DEPARTMENT_ID?>">
        <input type="hidden" id="OFFICE_CODE" name="OFFICE_CODE" value="<?=$OFFICE_CODE?>">
        <input type="hidden" id="AMOUNT" name="AMOUNT" value="<?=$AMOUNT?>">
        <input type="hidden" id="ACTION_CODE" name="ACTION_CODE" value="<?=$ACTION_CODE?>">
        <input type="hidden" id="SUB_SYSTEM" name="SUB_SYSTEM" value="<?=$SUB_SYSTEM?>">
    </form>
</main>
 <script>document.getElementById('frmgr').submit();</script>
</html>
