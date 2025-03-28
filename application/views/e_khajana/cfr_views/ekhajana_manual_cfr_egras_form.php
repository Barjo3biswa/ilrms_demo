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
            margin: auto;
            background-color: black; /* Solid black background */
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
            margin-top: 10px;
            font-size: 16px;
            font-weight: normal;
            color: #ffffff; /* White text for visibility */
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
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            background: none; /* Ensures no background image is applied */
        }

        .loader:after {
            content: '₹';
            display: inline-block;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            text-align: center;
            line-height: 60px;
            font-size: 50px;
            font-weight: bold;
            background-color: black; /* Matches the loader-wrap background */
            color: #50ff00; /* Green for the text */
            border: 4px double #50ff00; /* Green border */
            box-sizing: border-box;
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
  <form action="<?=$GRAS_PAY_LOAD['action']?>" name="frmgr" id="frmgr" method="post">
      <input type="hidden" id="DEPT_CODE" name="DEPT_CODE" value="<?=$GRAS_PAY_LOAD['DEPT_CODE']?>">
      <input type="hidden" id="PAYMENT_TYPE" name="PAYMENT_TYPE" value="<?=$GRAS_PAY_LOAD['PAYMENT_TYPE']?>">
      <input type="hidden" id="TREASURY_CODE" name="TREASURY_CODE" value="<?=$GRAS_PAY_LOAD['TREASURY_CODE']?>">
      <input type="hidden" id="OFFICE_CODE" name="OFFICE_CODE" value="<?=$GRAS_PAY_LOAD['OFFICE_CODE']?>">
      <input type="hidden" id="REC_FIN_YEAR" name="REC_FIN_YEAR" value="<?=$GRAS_PAY_LOAD['REC_FIN_YEAR']?>">
      <input type="hidden" id="PERIOD" name="PERIOD" value="<?=$GRAS_PAY_LOAD['PERIOD']?>">
      <input type="hidden" id="FROM_DATE" name="FROM_DATE" value="<?=$GRAS_PAY_LOAD['FROM_DATE']?>">
      <input type="hidden" id="TO_DATE" name="TO_DATE" value="<?=$GRAS_PAY_LOAD['TO_DATE']?>">
      <input type="hidden" id="MAJOR_HEAD" name="MAJOR_HEAD" value="<?=$GRAS_PAY_LOAD['MAJOR_HEAD']?>">
      <input type="hidden" id="HOA1" name="HOA1" value="<?=$GRAS_PAY_LOAD['HOA1']?>">
      <input type="hidden" id="AMOUNT1" name="AMOUNT1" value="<?=$GRAS_PAY_LOAD['AMOUNT1']?>">
      <input type="hidden" id="HOA2" name="HOA2" value="">
      <input type="hidden" id="AMOUNT2" name="AMOUNT2" value="">
      <input type="hidden" id="HOA3" name="HOA3" value="">
      <input type="hidden" id="AMOUNT3" name="AMOUNT3" value="">
      <input type="hidden" id="HOA4" name="HOA4" value="">
      <input type="hidden" id="AMOUNT4" name="AMOUNT4" value="">
      <input type="hidden" id="HOA5" name="HOA5" value="">
      <input type="hidden" id="AMOUNT5" name="AMOUNT5" value="">
      <input type="hidden" id="HOA6" name="HOA6" value="">
      <input type="hidden" id="AMOUNT6" name="AMOUNT6" value="">
      <input type="hidden" id="HOA7" name="HOA7" value="">
      <input type="hidden" id="AMOUNT7" name="AMOUNT7" value="">
      <input type="hidden" id="HOA8" name="HOA8" value="">
      <input type="hidden" id="AMOUNT8" name="AMOUNT8" value="">
      <input type="hidden" id="HOA9" name="HOA9" value="">
      <input type="hidden" id="AMOUNT9" name="AMOUNT9" value="">
      <input type="hidden" id="CHALLAN_AMOUNT" name="CHALLAN_AMOUNT" value="<?=$GRAS_PAY_LOAD['CHALLAN_AMOUNT']?>">
      <input type="hidden" id="MULTITRANSFER" name="MULTITRANSFER" value="<?=$GRAS_PAY_LOAD['MULTITRANSFER']?>">
      <input type="hidden" id="NON_TREASURY_PAYMENT_TYPE" name="NON_TREASURY_PAYMENT_TYPE" value="<?=$GRAS_PAY_LOAD['NON_TREASURY_PAYMENT_TYPE']?>">      
      <input type="hidden" id="AC1_AMOUNT" name="AC1_AMOUNT" value="<?=$GRAS_PAY_LOAD['TOTAL_NON_TREASURY_AMOUNT']?>">
      
      <input type="hidden" id="ACCOUNT1" name="ACCOUNT1" value="<?=$GRAS_PAY_LOAD['NON_TREASURY_ACCOUNT_CODE']?>">
      

      <input type="hidden" id="TOTAL_NON_TREASURY_AMOUNT" name="TOTAL_NON_TREASURY_AMOUNT" value="<?=$GRAS_PAY_LOAD['TOTAL_NON_TREASURY_AMOUNT']?>">
      <input type="hidden" id="TAX_ID" name="TAX_ID" value="">
      <input type="hidden" id="PAN_NO" name="PAN_NO" value="<?=$GRAS_PAY_LOAD['PAN_NO']?>">
      <input type="hidden" id="PARTY_NAME" name="PARTY_NAME" value="<?=$GRAS_PAY_LOAD['PARTY_NAME']?>">
      <input type="hidden" id="ADDRESS1" name="ADDRESS1" value="<?=$GRAS_PAY_LOAD['ADDRESS1'] ?>">
      <input type="hidden" id="ADDRESS2" name="ADDRESS2" value="<?=$GRAS_PAY_LOAD['ADDRESS2'] ?>">
      <input type="hidden" id="ADDRESS3" name="ADDRESS3" value="<?=$GRAS_PAY_LOAD['ADDRESS3'] ?>">
      <input type="hidden" id="PIN_NO" name="PIN_NO" value="<?=$GRAS_PAY_LOAD['PIN_NO']?>">
      <input type="hidden" id="MOBILE_NO" name="MOBILE_NO" value="<?=$GRAS_PAY_LOAD['MOBILE_NO']?>">
      <input type="hidden" id="DEPARTMENT_ID" name="DEPARTMENT_ID" value="<?=$GRAS_PAY_LOAD['DEPARTMENT_ID']?>">
      <input type="hidden" id="REMARKS" name="REMARKS" value="">
      <input type="hidden" id="SUB_SYSTEM" name="SUB_SYSTEM" value="<?=$GRAS_PAY_LOAD['SUB_SYSTEM']?>">
      <input type="hidden" id="FORM_ID" name="FORM_ID" value="">
  </form>
</main>
 <script>document.getElementById('frmgr').submit();</script>
</html>
