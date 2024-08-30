
function verif()
{
	let i;
	let nom = f.nom.value.toUpperCase();
	let tel = f.tel.value;

	for(i = 0; i < nom.length; i++)
	{
		if(((nom.charAt(i) < 'A') || (nom.charAt(i) > 'Z')) && (nom.charAt(i) != ' '))
		{
			alert("Nom Invalide");
			return false;
		}
	}

		for(i = 0; i < tel.length; i++)
		{
			if((tel.charAt(i) < '0') || (tel.charAt(i) > '9') || (tel.length != 8))
			{
				alert("Num tel invalide");
				return false;
			}
		}


	}