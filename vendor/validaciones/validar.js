		$( document ).ready( function () {
			$( "#formulario" ).validate( {
				rules: {
					nombre: {
						required: true,
						maxlength: 20
					},
					apellido: {
						required: true,
						maxlength: 20
					},
					cedula: {
						required: true,
						digits: true,
						maxlength: 10
					},
					pass: {
						required: true,
						rangelength: [5, 16]
					},
					pass2: {
						required: true,
						equalTo: "#registrar-password"
					},
					correo: {
						required: true,
						email: true,
						maxlength: 35
					}
				},
				messages: {
					nombre: {
						required: "Por favor, introduce tu nombre",
                        maxlength: "Límite de caracteres excedido"
					},
					apellido: {
						required: "Por favor, introduce tu apellido",
                        maxlength: "Límite de caracteres excedido"
					},
					cedula: {
						required: "Por favor, introduce tu cedula",
						digits: "Este campo no permite caracteres especiales",
						maxlength: "Límite de caracteres excedido"
					},
					pass: {
						required: "Por favor, introduce tu contraseña",
						rangelength: "Por favor introduce una contraseña de entre 5 y 16 caracteres"
					},
					pass2: {
						required: "Por favor, introduce tu contraseña",
						equalTo: "Las contraseñas no coinciden"
					},
					correo: {
                        required: "Por favor, introduce tu correo electronico",
						email: "Por favor, introduce un correo electronico valido",
						maxlength: "Límite de caracteres excedido"
                    }
				},
				errorElement: "em",
				errorPlacement: function ( error, element ) {
					// Add the `help-block` class to the error element
					error.addClass( "help-block" );

					if ( element.prop( "type" ) === "checkbox" ) {
						error.insertAfter( element.parent( "label" ) );
					} else {
						error.insertAfter( element );
					}
				},
				highlight: function ( element, errorClass, validClass ) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
				},
				unhighlight: function (element, errorClass, validClass) {
					$( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
				}
            });
        });