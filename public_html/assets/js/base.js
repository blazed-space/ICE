/* BLZ-template base.js */

/* 
    tb(c,d)
    @Desc Toggles mobile menu
    @Param c, d
    @Return void
*/
function tb(c,d){
    document.getElementById(c).classList.toggle("is-active");
    document.getElementById(d).classList.toggle("is-active");
}