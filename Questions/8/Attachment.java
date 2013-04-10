
import java.util.*;

class Item 

	{
		public String  name;
		public Node    link;

		public Item (String name)
			{ 
				this.name  = name;
				this.link  = null;
			} 

		public void showit()
			{ 
				System.out.println("\n"+this.name);
			}

	}  
      
class Node 	
	
	{
		public char tag;
		public int  val;
		public Item ref;
		public Node head;
		public Node tail;

		public Node(String name)
			{ 
				this.tag ='S';
				this.ref = Attachment.install(name);
				this.head = null;
				this.tail = null;
			}

		public Node(int number)
			{ 
				this.tag = 'I';
				this.val = number;
				this.ref = null;
				this.head = null;
				this.tail = null;
			}

		public Node()
			{ 
				this.tag = 'L';
				this.val = 0;
				this.ref = null;
				this.head = null;
				this.tail = null;
			}

	} // END OF CLASS Node

/********************************************************************/
	public class Attachment 
			{
                            
				public static Hashtable symbolTable  = new Hashtable();
				public static Node nil = new Node();
				public static void dumpTable()
					{
						System.out.println("\n\n The list of symbols stored in the Symbol Table:");
						for (Enumeration e = symbolTable.elements(); e.hasMoreElements();)
						((Item)e.nextElement()).showit();
					}

	public static Item locate(String name)
					{ 
						Item temp;
						if (symbolTable.containsKey(name))
						{ 
							temp = (Item)symbolTable.get(name);
							return ((Item)symbolTable.get(name));
						}
						else
							return null;
					}

	public static Item install(String name)
					{ 
						Item temp;
						temp = locate(name);
						if (temp == null)
							{
								symbolTable.put(name, new Item(name));
								temp = (Item)symbolTable.get(name);
							}
						return temp;
					}


	public static void printList(Node p)
					{ 
						if (p == null)
							{
								System.out.println("\n Missing argument in printList"); return; }
								if (p.tag == 'S') System.out.print(p.ref.name+" ");
								else if (p.tag == 'I') System.out.print(p.val+" ");
								else if (p.tag == 'L')
								{ 
									System.out.print(" ( ");
									Node t = p.head;
									while (t != null) 
										{ 
											printList(t); t = t.tail; 
										}
									System.out.print(") ");
								}
							}

	public static Node copy(Node from)
					{ 
						Node into = new Node();
						if (from == null) return null;
						into.tag  = from.tag; 
						if (into.tag == 'S') into.ref = from.ref;
						else if (into.tag == 'I') into.val = from.val;
						else if (into.tag == 'L') into.head = copy(from.head);
						into.tail = copy(from.tail);
						return into;
					}


/**********************************************************************/
	public static Node cons(Node p, Node q)
					{ 
						Node r, s;
						if (p == null)
							{ 
								System.out.println("\n first argument is missing in cons\n");
								return null;
							}
						if (p.tail != null) 

						{ 	
								System.out.println("\n illegal sibling in the first argument\n");
								return null;
							}

						r = copy(p);
						s = null;

						if (q == null)
							{ 
								System.out.println("\n second argument is missing in cons\n");
								return null;
							} 
						if (q.tail != null) 
							{ 
								System.out.println("\n illegal sibling in the second argument\n");
								return null;
							}
						if (q.tag == 'L')
							s = copy(q); 
						else if (q.tag == 'S')  
							{ 
								if (q.ref.name.compareTo("nil") == 0)
								s = new Node();
							}
						else 
							{ 
								System.out.println("\n second argument in cons is not a list");
								return null;
							} 
   
						r.tail = s.head;
						s.head = r;
						return s;
			}                            // END of cons


	public static Node quote(String name) 
			{
						Node temp = new Node(name);
						temp.ref = locate(name);
						if (temp.ref == null) 
							{
								symbolTable.put(name, new Item(name));
								temp.ref = (Item) symbolTable.get(name);
							}
						return temp;
			}                       // END OF Quote



	public static Node setQ(String name, Node p) 
			{
						Item temp = install(name);
						temp.link = p;
						return temp.link;
			}             // END OF SetQ

	
	public static Node eval(String name)
			{
						if (name == null)
						{
							System.out.println("\n Empty list argument in eval\n");
							return null;
						}
						else
						{	
							Node result;
							if(symbolTable.get(name) != null)
							{   
								Item item = (Item)symbolTable.get(name);
								result = new Node(item.name);
								return result;
							}
						return null;
						}
			}                          // END OF Eval


	public static Node car(Node p)
			{ 	
						if (p == null)
							{ 
								System.out.println("\n Argument is missing in car\n");
								return null;
							}
						else if (p.tag != 'L')
							{ 
								System.out.println("\n Wrong argument in car\n");
								return null;
							}
						else if (p.tail != null)
							{ 
								System.out.println("\n Illegal sibling in argument of car\n");
								return null;
							}
						else if (p.head == null)
							{ 
								System.out.println("\n Empty list argument in car\n");
								return null;
							}
						else
							{ 
								Node z = copy(p);
								(z.head).tail = null;
								return z.head;
							}
			}                                  // END OF car


	public static Node couder(Node p)
			{
						if (p == null)
							{
								System.out.println("\n Missing argument in car\n");
								return null;
							}
						else if (p.head == null)
							{
								System.out.println("\n Empty list argument in car\n");
								return null;
							}
						else if (p.tag != 'L')
							{
								System.out.println("\n Wrong argument in car\n");
								return null;
							}
						else if (p.tail != null)
							{
								System.out.println("\n Illegal sibling in the argument of car\n");
								return null;
							}
						else
							{
								Node p1 = copy(p);
								Node p2 = new Node();
								p2.head = (p1.head).tail;
								return p2;
							}
			}                         //END OF couder


	public static Node append(Node p, Node q)
			{
						Node a, b;
						if (p == null)
						{
							System.out.println("\n The first argument is missing \n");
							return null;
						}
						if (q == null)
						{
							System.out.println("\n The second argument is missing \n");
							return null;
						}
						if (p.tail != null)
						{
							System.out.println("\n Illegal sibling in the first argument!\n");
							return null;
						}
						if (q.tail != null)
						{
							System.out.println("\n Illegal sibling in the second argument!\n");
							return null;
						}
						if (p.tag != 'L')
						{
							System.out.println("\nThe first argument is not a list \n");
							return null;
						}
						if (q.tag != 'L')
						{
							System.out.println("\nThe second argument is not a list \n");
							return null;
						}
						a = copy(p);
						b = copy(q);
						a.tail = b.head;
						b.head = a;
						b.tail = null;
						return b;
			}                      //END OF append
	

	public static Node cutlast(Node p)
			{

						if (p == null)
						{
							System.out.println("\n Missing argument in car\n");
							return null;
						}
						else if (p.tag != 'L')
						{
							System.out.println("\n Wrong argument in car\n");
							return null;
						}
						else if (p.tail != null)
						{
							System.out.println("\n Illegal sibling in the argument of car\n");
							return null;
						}
						else if (p.head == null)
						{
							System.out.println("\n Empty list argument in car\n");
							return null;
						}
						else
						{
							Node a = p.head;
							Node b = a.tail;

								while(a.tail.tail != null)
								{
									a = b;
									b = a.tail;	        		
								}

									a = null;
									return p;
						 }
			}                     // END OF Cutlast


	public static void atom(Node x) 
			{
					Node temp = copy(x);
						
						if (x.tag == 'S')
							{
								System.out.println("T");
							} 
						else if (x.tag == 'I') 
							{
								System.out.println("T");
							} 
						else if (x.tag == 'L') 
							{
								System.out.println("nil");
							}
			}                      // END OF Atom

	public static Node Sum(Node p)
			{
					if (p == null)
							{
								System.out.println("\n Missing argument in car\n");
								return null;
							}
					else if (p.tag != 'L')
							{
								System.out.println("\n Wrong argument in car\n");
								return null;
							}
					else if (p.tail != null)
							{
								System.out.println("\n Illegal sibling in the argument of car\n");
								return null;
							}
					else if (p.head == null)
							{
								System.out.println("\n Empty list argument in car\n");
								return null;
							}
					else
							{
								Node a = new Node(0);
								Node b = p.head;
								while (b != null)
									{
										a.val = a.val + b.val;
										b = b.tail;
									}
								return a;
							}
			}                 // END OF sum

	public static Node Product(Node p)
			{
					if (p == null)
							{
								System.out.println("\n There is a missing argument in car\n");
								return null;
							}
					else if (p.tag != 'L')
							{
								System.out.println("\n There is a wrong argument in car\n");
								return null;
							}
					else if (p.tail != null)
							{
								System.out.println("\n Illegal sibling in the argument of car\n");
								return null;
							}
					else if (p.head == null)
							{
								System.out.println("\n Empty list argument in car\n");
								return null;
							}
					else
							{
								Node a = new Node(1);
								Node b = p.head;
								while (b != null)
									{
										a.val = a.val * b.val;
										b = b.tail;
									}
								return a;
							}
			}                           //END OF Product


	public static Node maximum (Node p, Node q)
			{
				Node t=new Node("");
				if (p == null)
							{
								System.out.println("\n first argument missing in maximum\n");
								return null;
							}
				if (q == null)
							{
								System.out.println("\n second argument missing in maximum\n");
								return null;
							}
				if (p.tag != 'I')
							{
								System.out.println("\n first argument is not a Integer in maximum\n");
								return null;
							}
				if (q.tag != 'I')
							{
								System.out.println("\n Second argument is not a Integer in maximum\n");
								return null;
							}
				else
							{
								if(p.val > q.val)
									{
										Item temp = (Item)symbolTable.get("t");
										t.ref=temp;
										return t;
									}
								else
									{
										Item temp = (Item)symbolTable.get("nil");
										t.ref=temp;
										return t;
									}
							}
			}                                 //END OF Maximum


	public static Node or(Node p, Node q)
			{
					Node a1 = new Node("nil");
					Node b1 = new Node("t");
					if (p == null || q == null)
									{
										System.out.println("\n Empty \n");
										return null;
									}
					else if (p.tag == 'I' || p.tag == 'L')
									{
										System.out.println("\n The first one is wrong argument\n");
										return null;
									}
					else if (q.tag == 'I' || q.tag == 'L')
									{
										System.out.println("\n The second one is wrong argument\n");
										return null;
									}
					else
									{
										if(p.ref.name.equals("nil") && q.ref.name.equals("nil") ) 
										{
										return a1;
										}
					else 	
									{
										return b1;
									}
									}
			}                                        // END OF or


	public static Node and(Node p, Node q)
			{
					Node a1 = new Node("nil");
					Node b1 = new Node("t");
					if (p == null || q == null)
									{
										System.out.println("\n Empty \n");
										return null;
									}
					else if (p.tag == 'I' || p.tag == 'L')
									{
										System.out.println("\nfirst one is  wrong argument\n");
										return null;
									}
					else if (q.tag == 'I' || q.tag == 'L')
									{
										System.out.println("\n second one is Wrong argument\n");
										return null;
									}
					else
									{
										if(p.ref.name.equals("t") && q.ref.name.equals("t") ) 
										{
										return b1;
										}
					else 
									{
										return a1;
									}
									}
			}                                // END OF and


	public static Node Not(Node p)
			{
					Node a1 = new Node("nil");
					Node b1 = new Node("t");
					if (p == null)
									{
										System.out.println("\n Empty \n");
										return null;
									}
					else if (p.tag == 'I' || p.tag == 'L')
									{
										System.out.println("\nfirst one is wrong argument\n");
										return null;
									}
					else
									{
										if(p.ref.name.equals("t") ) 
											{
												return a1;
											}
					else 	
									{
										return b1;
									}
									}
			}                                    //END OF not

	public static Node ifexpression(Node p,Node q,Node r)
			{
				Node ret= new Node();
				if (p == nil)
				return r;
				else
									{
										if(p.tag=='S' && p.ref.name.equals("nil"))
										return r;
										else if(p.tag=='S' && p.ref.name.equals("t"))
										return q;
										else if(p.tag=='S')
											{
												ret =  eval(p.ref.name);
												return ret;
											}
										else
											{
											ret=new Node("Invalid");
											return ret;
											}
									}
			}          // END OF if

	public static Node fnull(Node p)
			{
				if (p == null)
					{
						System.out.println("\n Empty\n");
						return null;
					}
				else if (p.tag == 'S') 
					{
						if((p.ref.name).equals("nil"))
							{
								return new Node("t");
							}
					}
				return new Node("nil");
			}

	
	public static Node numberp(Node p)
			{
				if (p.tag == 'I')
					{
						return new Node("t");
					}
				else
					{
						return new Node("nil");
					}
			}                           // END of null





/**************************************************************************/

	public static void main(String argv[])
		{ 
			  symbolTable.put("nil", new Item("nil"));
			  symbolTable.put("t", new Item("t"));
			  
			  Node a = new Node("THIS"); 
			  Node b = new Node("WILL");
			  Node c = new Node("BE");
			  Node d = new Node("FUN");
			  Node e = new Node("nil");  // The string "nil" as the empty list
			
			  System.out.println();
			  printList(e);
			  System.out.println();
			  printList(cons(a, e));
			
			  System.out.println();
			  printList(nil);
			  System.out.println();
			  printList(cons(d, nil));
			  System.out.println();
			  printList(cons(c, cons(d, nil)));
			  System.out.println();
			  printList(cons(b, cons(c, cons(d, nil))));
			  System.out.println();
			  printList(cons(a, cons(b, cons(c, cons(d, nil)))));
		
			  System.out.println();
			  printList(nil);
			  Node t = cons(d, nil);
			  System.out.println(); printList(t);
			  Node u = cons(c, t);
			  System.out.println(); printList(u);
			  Node v = cons(b, u);
			  System.out.println(); printList(v);
			  Node w = cons(a, v);
			  System.out.println(); printList(w);

			  System.out.println();
			  Node zero  = new Node(0);  
			  Node one   = new Node(1);
			  Node two   = new Node(2);
			  Node three = new Node(3);
			  Node p = cons(three, nil);
			  p = cons(two, p);
			  p = cons(one, p);
			  p = cons(zero, p);
			 
			  dumpTable();
			  System.out.println();
			  System.out.println();


			 System.out.println("****************LISP Functions******************");
			 Node output; 
			 System.out.println();
  
			 System.out.println(); 
			 System.out.print("List p = ");
			 printList(p);
			 System.out.println();			  
			  
			 Node q = cons(p, w);
			 System.out.println(); 
			 System.out.print("Node q = ");
			 printList(q); 
			 System.out.println();
			 
			 System.out.print("\n" + "Node quote ");
		     printList(a);
		     output = quote("= This");
		     printList(output);
		     System.out.println();	

		     System.out.print("\n" + "Node setQ  A ");
		     printList(new Node(21));
		     output = setQ("A", new Node(21));
		     System.out.print("\n" + "output= ");
		     printList(output);
		     System.out.println();
		    
			 System.out.println("\n" + "Node Eval a =");
			 Node opt=eval("a");
			 if(opt!=null) printList(eval("a"));
			 else System.out.println("null");
  
			 System.out.println();
			 System.out.print("Node car(p) = ");
			 Node P = copy(p);
			 printList(car(P));
			 Node one1 = copy(p);
			 System.out.println();
			 System.out.println();
			  
			
	          System.out.println("Node Couder(p) = ");
		      printList(couder(one1));
			  System.out.println("\n");
			            
			            
			  System.out.print("Node append(p,q) = ");
			  Node R = copy(p);
			  Node app = append(R, w);
			  printList(app);
			  System.out.println();
			  System.out.println();
			  
    		
			   System.out.print("Node cutlast(p) = ");
			   Node T = copy(p);
			   Node clk = cutlast(T);
			   printList(clk);
			   System.out.println();
			
			  
				System.out.print("\n" + "(atom = ");
			    printList(p);
			    System.out.print(") \n");
			    atom(p);
			    System.out.println();
			    
			
				System.out.print("Node sum_of(p) = ");
				Node U = copy(p);
				Node sm = Sum(U);
				printList(sm);
				System.out.println();
				System.out.println();
			  
	
				System.out.print("Node Product_of(p) = ");
				Node W = copy(p);
				Node prd = Product(W);
				printList(prd);
				System.out.println();
			
				
				System.out.println("\n"+"Node Max_of");
				printList(zero);
				printList(one);
				output= maximum(zero,one);
				printList(output);
				System.out.println("\n");
				  
				Node nil= new Node("nil");
				Node tru= new Node("t");
				System.out.println("\n"+"Node or");
				printList(nil);
				printList(tru);
				System.out.println("\n");
				printList(or(nil,tru));
				System.out.println("\n");
	
	  
				  System.out.println("\n" + "Node and");
				  printList(nil);
				  printList(tru);
				  System.out.println("\n");
				  printList(and(nil,tru));
				  System.out.println("\n");
				  
				  System.out.println("\n" + "Node not");
				  printList(nil);
				  output=Not(nil);
				  System.out.println("\nOutput=");
				  printList(output);
				  System.out.println("\n");
				  
				  System.out.print("(f f nil) are inputs so it should return value of f ie 3\n");
				  Node f= new Node("3");
				  Node ifexpr1 = ifexpression(f,f,nil);
				  printList(new Node("f"));
				  printList(new Node("f"));
				  printList(nil);
				  System.out.print("\nOutput=");
				  printList(ifexpr1);
				  System.out.println("\n");
	  
				  System.out.println("\n"+"null_p");
				  printList(d);
				  System.out.println("\nOutput=");
				  printList(fnull(d));
				  System.out.println("\n");
				   
				  System.out.println("\n ************Lisper Program Finished*****************");

} // END of main 


} // END OF CLASS Attachment






 
