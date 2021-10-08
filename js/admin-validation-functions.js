function isEmpty(strEmpty)
{
    if(strEmpty=="" || strEmpty==null)
    {
    	return 1;
    }
    return 0;
}


function isNumeric(strNumeric)
{
    for(i=0 ; i<strNumeric.length ; i++)
    {
        ch=strNumeric.charAt(i);
        if( ch<"0" || ch>"9" )
        {
            return 1;
        }
    }
    return 0;
}

function isDecimal(strDecimal)
{
	var strRes=strDecimal.split(".");
	if(strRes.length==1)
	{
		var part11=isNumeric(strRes[0]);
		var part12=isLimit(strRes[0],-1);
		if(part11==1 || part12==1)
		{
			return 1;
		}
	}
	if(strRes.length==2)
	{
		var part11=isNumeric(strRes[0]);
		var part12=isLimit(strRes[0],-1);
		var part21=isNumeric(strRes[1]);
		var part22=isLimit(strRes[1],0);
		var part23=isSize(strRes[1],0,2);
		if(part11==1 || part12==1 || part21==1 || part22==1 || part23==1)
		{
			return 1;
		}
	}
	if(strRes.length>2)
	{
		return 1;
	}	
    return 0;
}

function isAlphabet(strAlphabet)
{
    for(i=0 ; i<strAlphabet.length ; i++)
    {
        ch=strAlphabet.charAt(i);
        if( !( (ch>="a" && ch<="z") || (ch>="A" && ch<="Z") ) )
        {
            return 1;
        }
    }
    return 0;
}

function isSize(strSize,min,max)
{
	if(strSize.length<min || strSize.length>max)
	{
		return 1;
	}
	return 0;
}

function isLimit(strLimit,limit)
{
	if(strLimit<=limit)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}



function isEmail(strEmail)
{
    var lastDot=strEmail.lastIndexOf(".");
    var firstAt=strEmail.indexOf("@");
    var lastAt=strEmail.lastIndexOf("@");
    var length=strEmail.length;
    if(lastDot==-1 || firstAt==-1)
    {
        return 1;
    }
    for(i=0 ; i< length ; i++)
    {
        var ch=strEmail.charAt(i);
        if( !( (ch>="a" && ch<="z") ||
                (ch>="A" && ch<="Z") ||
                (ch>="0" && ch<= "9") ||
                (ch== "_") || (ch== ".") ||
                (ch== "@") || (ch== "-") ) )
        {
                return 1;
        }
    }
    if(firstAt!=lastAt)
    {
        return 1;
    }
    if( (strEmail.indexOf("..")!=-1) || (strEmail.indexOf("._")!=-1) ||
    (strEmail.indexOf("_.")!=-1) || (strEmail.indexOf("@.")!=-1) || (strEmail.indexOf(".@")!=-1)
    || (strEmail.indexOf("_@")!=-1) || (strEmail.indexOf("@_")!=-1) ||
    (strEmail.indexOf("__")!=-1) )
    {
        return 1;
    }
    if( (length-lastDot<3) || (lastAt>lastDot) )
    {
        return 1;
    }
    return 0;
}

function pass_comb(pass_val)
{
	var chlength=pass_val.length;
	var small=0;
	var capital=0;
	var number=0;
	var special=0;
	var ch="";
	
	for(chval=0; chval<chlength; chval++)
	{
		ch=pass_val.charAt(chval);
		if(ch>="a" && ch<="z")
		{
			small++;
		}
		else if(ch>="A" && ch<="Z")
		{
			capital++;
		}
		else if(ch>="0" && ch<="9")
		{
			number++;
		}
		else
		{
			special++;
		}
	}
	if((small>=1 || capital>=1) && number>=1 && special>=1)
	{
		return true;
	}
	else
	{
		return false;
	}
}