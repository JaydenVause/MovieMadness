					// add event listener to document
					document.addEventListener('click', function(e) {

						   		e = e || window.event;
						    	var target = e.target;
						       
						        
						        //  if its a click on the right arrow
						        // console.log(target);
						        // scroll
						        if(target.classList.contains('next-arrow--right')){
						        	
						        	var x = target.parentNode.getElementsByClassName('container--ibox__ul');
						        	var ulx = x[0];
						        	var scrollpost = ulx.scrollLeft;
						        	var childNodes = ulx.childNodes.length;
						        	// console.log(childNodes);
						        	// console.log(ulx.clientWidth);
						        	var scrollWidth = ulx.clientWidth / childNodes;
						        	console.log(scrollWidth);
						        	var scrollpost = scrollpost + scrollWidth ;
						        	ulx.scroll( scrollpost, 0);
						        }

						        // if its a click on the left arrow
						        // scroll
						        if(target.classList.contains('next-arrow--left')){
						        	
						        	var x = target.parentNode.getElementsByClassName('container--ibox__ul');
						        	var ulx = x[0];
						        	// get scroll left amount
						        	var scrollpost = ulx.scrollLeft;
						        	// get amount of child elements
						        	var childNodes = ulx.childNodes.length;
						        	// console.log(childNodes);
						        	// console.log(ulx.clientWidth);
						        	// get amount to scroll by
						        	var scrollWidth = ulx.clientWidth / childNodes;
						        	console.log(scrollWidth);
						        	var scrollpost = scrollpost - scrollWidth ;
						        	ulx.scroll( scrollpost, 0);
						        }

						}, false);

						function scroll_right_arrow(RightArrow){
							let parentNode = RightArrow.parentNode;
							parentNode.selec
						}