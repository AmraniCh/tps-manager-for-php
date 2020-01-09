$(document).ready(function(){
		var editorElement = $(".codemirror-textarea");
		$(editorElement).each(function(index, value){
			var editor = CodeMirror.fromTextArea(editorElement[index], {
					mode: "text/x-php",
					lineNumbers: true,
					matchBrackets: true,
					theme: "moxer",
					lineWiseCopyCut: true,
					undoDepth: 200,
					lineWrapping : false,
					autoRefresh:true,
					styleActiveLine: true,
					fixedGutter:true,
					lint:true,
					coverGutterNextToScrollbar:false,
					gutters: ['CodeMirror-lint-markers']
				});
				editor.setValue("<?php\n\techo 'hello world!';\n?>");
		});

	$('#run').click(function(){

		var content = editor.getValue();
		$.ajax({
			url: "editor-writing.php",
			method: "POST",
			data: { content: content },
			success: function(){
			},
			complete: function(){
				$.get(
					"editor-processing.php",
					function(data){
						$(".codemirror-output").val(data);
					}
				);
			}
		});

		$.post(
			"test.php",
			{ content: content },
			function(data){
				$(".codemirror-output").val(data);
			}
		);
	});
});
