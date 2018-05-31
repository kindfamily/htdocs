<html>
<head>
<title>jQuery add / remove textbox example</title>

<script type="text/javascript" src="jquery-1.3.2.min.js"></script>

<style type="text/css">
   body
{
    font-family:Gill Sans MT;
    padding:10px;
}
fieldset
{
    border: solid 1px #000;
    padding:10px;
    display:block;
    clear:both;
    margin:5px 0px;
}
legend
{
    padding:0px 10px;
    background:black;
    color:#FFF;
}
input.add
{
    float:right;
}
input.fieldname
{
    float:left;
    clear:left;
    display:block;
    margin:5px;
}
select.fieldtype
{
    float:left;
    display:block;
    margin:5px;
}
input.remove
{
    float:left;
    display:block;
    margin:5px;
}
#yourform label
{
    float:left;
    clear:left;
    display:block;
    margin:5px;
}
#yourform input, #yourform textarea
{
    float:left;
    display:block;
    margin:5px;
}

</style>

</head>

<body>
    <fieldset id="buildyourform">
    <legend>Build your own form!</legend>
    </fieldset>
    <input type="button" value="Preview form" class="add" id="preview" />
    <input type="button" value="Add a field" class="add" id="add" />

    <script type="text/javascript">

    $(document).ready(function() {
        $("#add").click(function() {
            var lastField = $("#buildyourform div:last");
            var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
            var fieldWrapper = $("<div class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
            fieldWrapper.data("idx", intId);
            var fName = $("<input type=\"text\" class=\"fieldname\" />");
            var fType = $("<select class=\"fieldtype\"><option value=\"checkbox\">Checked</option><option value=\"textbox\">Text</option><option value=\"textarea\">Paragraph</option></select>");
            var removeButton = $("<input type=\"button\" class=\"remove\" value=\"-\" />");
            removeButton.click(function() {
                $(this).parent().remove();
            });
            fieldWrapper.append(fName);
            fieldWrapper.append(fType);
            fieldWrapper.append(removeButton);
            $("#buildyourform").append(fieldWrapper);
        });
        $("#preview").click(function() {
            $("#yourform").remove();
            var fieldSet = $("<fieldset id=\"yourform\"><legend>Your Form</legend></fieldset>");
            $("#buildyourform div").each(function() {
                var id = "input" + $(this).attr("id").replace("field","");
                var label = $("<label for=\"" + id + "\">" + $(this).find("input.fieldname").first().val() + "</label>");
                var input;
                switch ($(this).find("select.fieldtype").first().val()) {
                    case "checkbox":
                        input = $("<input type=\"checkbox\" id=\"" + id + "\" name=\"" + id + "\" />");
                        break;
                    case "textbox":
                        input = $("<input type=\"text\" id=\"" + id + "\" name=\"" + id + "\" />");
                        break;
                    case "textarea":
                        input = $("<textarea id=\"" + id + "\" name=\"" + id + "\" ></textarea>");
                        break;    
                }
                fieldSet.append(label);
                fieldSet.append(input);
            });
            $("body").append(fieldSet);
        });
    });
    </script>
</body>
</html>