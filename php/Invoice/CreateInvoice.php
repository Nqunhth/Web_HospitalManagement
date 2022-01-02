<?php


class CreateInvoice
{
    public static function Create()
    {

        if (
            !empty($_SESSION['mediCusName']) && !empty($_SESSION['mediAddress']) && !empty($_SESSION['mediId_1']) && !empty($_SESSION['mediTotal'])
        ) {
            $newInvoice =
                Invoice::withFullInfo(
                    $_SESSION['mediCusName'],
                    $_SESSION['mediAddress'],
                    $_SESSION['user_id'],
                    $_SESSION['mediTotal']
                );
            if (
                   ($_SESSION['mediName_1'] != '' && $_SESSION['mediCost_1'] == 0)
                || ($_SESSION['mediName_2'] != '' && $_SESSION['mediCost_2'] == 0)
                || ($_SESSION['mediName_3'] != '' && $_SESSION['mediCost_3'] == 0)
                || ($_SESSION['mediName_4'] != '' && $_SESSION['mediCost_4'] == 0)
                || ($_SESSION['mediName_5'] != '' && $_SESSION['mediCost_5'] == 0)
            ) {
                return "Create Failed. Wrong medicine";
            } else {                
                if ($newInvoice->postToDataBase()) {
                    $invoice = Invoice::fetchNewInvoice();
                    if ($invoice->num_rows > 0) {
                        $invoice = $invoice->fetch_assoc();
                        if ($_SESSION['mediId_1'] != null || $_SESSION['mediId_1'] != '') {
                            $newInMe_1 =
                                InvoiceMedicine::withFullInfo(
                                    $_SESSION['mediId_1'],
                                    $_SESSION['mediName_1'],
                                    $invoice['invo_id'],
                                    $_SESSION['mediQuantity_1'],
                                    $_SESSION['mediCost_1']
                                );
                            $temp = $newInMe_1->postToDataBase();
                        }

                        if ($_SESSION['mediId_2'] != null || $_SESSION['mediId_2'] != '') {
                            $newInMe_2 =
                                InvoiceMedicine::withFullInfo(
                                    $_SESSION['mediId_2'],
                                    $_SESSION['mediName_2'],
                                    $invoice['invo_id'],
                                    $_SESSION['mediQuantity_2'],
                                    $_SESSION['mediCost_2']
                                );
                            $temp = $newInMe_2->postToDataBase();
                        }

                        if ($_SESSION['mediId_3'] != null || $_SESSION['mediId_3'] != '') {
                            $newInMe_3 =
                                InvoiceMedicine::withFullInfo(
                                    $_SESSION['mediId_3'],
                                    $_SESSION['mediName_3'],
                                    $invoice['invo_id'],
                                    $_SESSION['mediQuantity_3'],
                                    $_SESSION['mediCost_3']
                                );
                            $temp = $newInMe_3->postToDataBase();
                        }

                        if ($_SESSION['mediId_4'] != null || $_SESSION['mediId_4'] != '') {
                            $newInMe_4 =
                                InvoiceMedicine::withFullInfo(
                                    $_SESSION['mediId_4'],
                                    $_SESSION['mediName_4'],
                                    $invoice['invo_id'],
                                    $_SESSION['mediQuantity_4'],
                                    $_SESSION['mediCost_4']
                                );
                            $temp = $newInMe_4->postToDataBase();
                        }

                        if ($_SESSION['mediId_5'] != null || $_SESSION['mediId_5'] != '') {
                            $newInMe_5 =
                                InvoiceMedicine::withFullInfo(
                                    $_SESSION['mediId_5'],
                                    $_SESSION['mediName_5'],
                                    $invoice['invo_id'],
                                    $_SESSION['mediQuantity_5'],
                                    $_SESSION['mediCost_5']
                                );
                            $temp = $newInMe_5->postToDataBase();
                        }
                        return "Create Successfull";
                    }
                }
            };
        } else {
            return "All field required!";
        };
    }
    public static function resetAllSession()
    {
        $_SESSION['mediTotal'] = 0;

        $_SESSION['mediId_1'] = '';
        $_SESSION['mediName_1'] = '';
        $_SESSION['mediUnit_1'] = '';
        $_SESSION['mediUnitPrice_1'] = '';
        $_SESSION['mediQuantity_1'] = '';
        $_SESSION['mediCost_1'] = 0;

        $_SESSION['mediId_2'] = '';
        $_SESSION['mediName_2'] = '';
        $_SESSION['mediUnit_2'] = '';
        $_SESSION['mediUnitPrice_2'] = '';
        $_SESSION['mediQuantity_2'] = '';
        $_SESSION['mediCost_2'] = 0;

        $_SESSION['mediId_3'] = '';
        $_SESSION['mediName_3'] = '';
        $_SESSION['mediUnit_3'] = '';
        $_SESSION['mediUnitPrice_3'] = '';
        $_SESSION['mediQuantity_3'] = '';
        $_SESSION['mediCost_3'] = 0;

        $_SESSION['mediId_4'] = '';
        $_SESSION['mediName_4'] = '';
        $_SESSION['mediUnit_4'] = '';
        $_SESSION['mediUnitPrice_4'] = '';
        $_SESSION['mediQuantity_4'] = '';
        $_SESSION['mediCost_4'] = 0;

        $_SESSION['mediId_5'] = '';
        $_SESSION['mediName_5'] = '';
        $_SESSION['mediUnit_5'] = '';
        $_SESSION['mediUnitPrice_5'] = '';
        $_SESSION['mediQuantity_5'] = '';
        $_SESSION['mediCost_5'] = 0;
    }
}
