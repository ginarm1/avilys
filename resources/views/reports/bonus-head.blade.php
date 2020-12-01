<style>
    #clients th{
        font-size: 15px;
    }
    #panel-orders-history,#panel-clients{
        display: grid;
        grid-gap: 0.7rem;
        grid-template-columns: repeat(4,1fr);
    }
    #orders-history-type{
        grid-column: 1/2;
    }
    .box-2{
        grid-column: 1/6;
    }
    .box-4{
        grid-column: 2/6;
    }
</style>
<?php
if (isset($_GET['cancel']))
{
    $_GET['name'] = '';
}
?>
<script>

    $(document).ready(function (){
        //  ----------------------
        $("#orders-history-type").change(function (){
            var str = "";
            $("#orders-history-type option:selected").each(function (){
                str += $( this ).text() + " ";
            });

            if(str === "Vardas ir pavardė "){

                $( "#surname-input" ).show();
            }else{
                $( "#surname-input" ).hide();
            }

        }).trigger("change");
        $("#clients-type").change(function (){
            var str = "";
            $("#clients-type option:selected").each(function (){
                str += $( this ).text() + " ";
            });

            if(str === "Vardas ir pavardė "){

                $( "#surname-input2" ).show();
            }else{
                $( "#surname-input2" ).hide();
            }

        }).trigger("change");
        //  ----------------------

    });
</script>




