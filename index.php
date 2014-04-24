<!DOCTYPE html>
<html lang="en">
 <head>
    <title>Paypal Website Payments Pro integration</title>
     <script type="application/javascript" src="js/jquery.min.js"></script>
     <script type="application/javascript" src="js/jquery.validate.js"></script>
     <script type="application/javascript" src="js/process.js"></script>
     <style>
         .error {
             color: #FF0000;
             font-weight: bold;
         }
     </style>
 </head>
 <body>
    <br>
    <font size=2 color=black face=Verdana><b>Do Direct Payment</b></font>
    <br><br>
    <form method="post" action="process.php" name="processform" id="processform">
    <table width="600" border="0">
        <tr>
            <td align=right>First Name:</td>
            <td align=left><input required="required" type="text" size="30" maxlength="32" name="firstName"></td>
        </tr>
        <tr>
            <td align=right>Last Name:</td>
            <td align=left><input required="required" type="text" size="30" maxlength="32" name="lastName"></td>
        </tr>
        <tr>
            <td align=right>Card Type:</td>
            <td align=left>
                <select required="required" name="creditCardType" onChange="changeCC();">
                    <option value="Visa" selected>Visa</option>
                    <option value="MasterCard">MasterCard</option>
                    <option value="Discover">Discover</option>
                    <option value="Amex">American Express</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align=right>Card Number:</td>
            <td align=left><input required="required" type="text" size="19" maxlength="19" name="creditCardNumber"></td>
        </tr>
        <tr>
            <td align=right>Expiration Date:</td>
            <td align=left><p>
                <select required="required" name="expDateMonth">
                    <option value="1">01</option>
                    <option value="2">02</option>
                    <option value="3">03</option>
                    <option value="4">04</option>
                    <option value="5">05</option>
                    <option value="6">06</option>
                    <option value="7">07</option>
                    <option value="8">08</option>
                    <option value="9">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <select required="required" name="expDateYear">
                    <?php $date = date("Y"); ?>
                    <?php for($i = 0; $i < 11 ; $i++) : ?>
                        <option value="<?php echo $date + $i;?>"><?php echo $date + $i;?></option>
                    <?php endfor; ?>
                </select>
            </p></td>
        </tr>
        <tr>
            <td align=right>Card Verification Number:</td>
            <td align=left><input required="required" type="text" size="3" maxlength="4" name="cvv2Number" value=962></td>
        </tr>
        <tr>
            <td align=right><br><b>Billing Address:</b></td>
        </tr>
        <tr>
            <td align=right>Address 1:</td>
            <td align=left><input type="text" size="25" maxlength="100" name="address1" value="1 Main St"></td>
        </tr>
        <tr>
            <td align=right>City:</td>
            <td align=left><input type="text" size="25" maxlength="40" name="city" value="San Jose"></td>
        </tr>
        <tr>
            <td align=right>State:</td>
            <td align=left>
                <select id="state" name="state">
                    <option value=""></option>
                    <option value="AK">AK</option>
                    <option value="AL">AL</option>
                    <option value="AR">AR</option>
                    <option value="AZ">AZ</option>
                    <option value="CA" selected>CA</option>
                    <option value="CO">CO</option>
                    <option value="CT">CT</option>
                    <option value="DC">DC</option>
                    <option value="DE">DE</option>
                    <option value="FL">FL</option>
                    <option value="GA">GA</option>
                    <option value="HI">HI</option>
                    <option value="IA">IA</option>
                    <option value="ID">ID</option>
                    <option value="IL">IL</option>
                    <option value="IN">IN</option>
                    <option value="KS">KS</option>
                    <option value="KY">KY</option>
                    <option value="LA">LA</option>
                    <option value="MA">MA</option>
                    <option value="MD">MD</option>
                    <option value="ME">ME</option>
                    <option value="MI">MI</option>
                    <option value="MN">MN</option>
                    <option value="MO">MO</option>
                    <option value="MS">MS</option>
                    <option value="MT">MT</option>
                    <option value="NC">NC</option>
                    <option value="ND">ND</option>
                    <option value="NE">NE</option>
                    <option value="NH">NH</option>
                    <option value="NJ">NJ</option>
                    <option value="NM">NM</option>
                    <option value="NV">NV</option>
                    <option value="NY">NY</option>
                    <option value="OH">OH</option>
                    <option value="OK">OK</option>
                    <option value="OR">OR</option>
                    <option value="PA">PA</option>
                    <option value="RI">RI</option>
                    <option value="SC">SC</option>
                    <option value="SD">SD</option>
                    <option value="TN">TN</option>
                    <option value="TX">TX</option>
                    <option value="UT">UT</option>
                    <option value="VA">VA</option>
                    <option value="VT">VT</option>
                    <option value="WA">WA</option>
                    <option value="WI">WI</option>
                    <option value="WV">WV</option>
                    <option value="WY">WY</option>
                    <option value="AA">AA</option>
                    <option value="AE">AE</option>
                    <option value="AP">AP</option>
                    <option value="AS">AS</option>
                    <option value="FM">FM</option>
                    <option value="GU">GU</option>
                    <option value="MH">MH</option>
                    <option value="MP">MP</option>
                    <option value="PR">PR</option>
                    <option value="PW">PW</option>
                    <option value="VI">VI</option>
                </select>
            </td>
        </tr>
        <tr>
            <td align=right>ZIP Code:</td>
            <td align=left><input required="required" type="text" size="10" maxlength="10" name="zip" value="95131">(5 or 9 digits)</td>
        </tr>
        <tr>
            <td align=right>Country:</td>
            <td align=left>United States</td>
        </tr>
        <tr>
            <td align=right><br>Amount:</td>
            <td align=left><br><input required="required" type="text" size="4" maxlength="7" name="amount" value="1.00"> USD</td>
        </tr>
        <tr>
            <td align=right><br>Recurring:</td>
            <td align=left><br><input type="checkbox" value="1" name="recurring"> Enable</td>
        </tr>
        <tr>
            <td align="right" valign="top">Recurring Detail:</td>
            <td align=left>
            <table width="100%" cellspacing="2">
                <tr>
                    <td>Billing Period</td>
                    <td>
                        <select name="billingPeriod">
                            <option value="Day">Day</option>
                            <option value="Week">Week</option>
                            <option value="SemiMonth">Semi Month</option>
                            <option value="Month">Month</option>
                            <option value="Year">Year</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Billing Frequency</td>
                    <td><input type="text" size="4" maxlength="7" name="billingFreq" value="1" size="2" maxlength="2"></td>
                </tr>

            </table>
            </td>
        </tr>
        <tr>
            <td/>
            <td><input type="Submit" value="Submit"></td>
        </tr>
    </table>
    </form>
</body>
</html>