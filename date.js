  Date.prototype.addDays = function(days) {
       var dat = new Date(this.valueOf())
       dat.setDate(dat.getDate() + days);
       return dat;
   }

   function getDates(startDate, stopDate) {
      var dateArray = new Array();
      var currentDate = startDate;
      while (currentDate <= stopDate) {
        dateArray.push(currentDate)
        currentDate = currentDate.addDays(1);
      }
      return dateArray;
    }
	
function getDates1(d1,m1,y1,d2,m2,y2,str)
{	
str1=m1+" "+d1+", "+y1;	
str2=m2+" "+d2+", "+y2;	
x=new Date(str1);
y=new Date(str2);
					

					
var dateArray = getDates(x,y);
	
	fl=0;
	for (i=0;i<dateArray.length;i++)
	{
		//alert(dateArray[i]);
		
		var n=str.localeCompare(dateArray[i].getFullYear()+"-"+(dateArray[i].getMonth()+1)+"-"+dateArray[i].getDate());
		var m=str.localeCompare(dateArray[i].getFullYear()+"-0"+(dateArray[i].getMonth()+1)+"-0"+dateArray[i].getDate());
		var o=str.localeCompare(dateArray[i].getFullYear()+"-"+(dateArray[i].getMonth()+1)+"-0"+dateArray[i].getDate());
		var p=str.localeCompare(dateArray[i].getFullYear()+"-0"+(dateArray[i].getMonth()+1)+"-"+dateArray[i].getDate());
		
		
		if(n==0||m==0 ||o==0 ||p==0)
		{fl=1}
	}
	return fl;
}