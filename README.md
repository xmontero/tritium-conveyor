tritium-conveyor
================

Trirum-Conveyor is a symfony2-based project intended to solve a mathematical problem via a genetic algorithm.

My goal with this project is to learn how to create a generic genetic algorithm in PHP reusable by other users.

Problem
-------

The problem to solve is the following:

Place the numbers 1 to 19 in the following grid provided that each 3 numbers on each side of the hexagon, and each 3 numbers on the radius of the hexagon sums the same N.

Reference: http://www.primepuzzles.net/puzzles/puzz_130.htm

The solution can be found with N=22 to N=29 and N=31. N=30 is not solvable.

	    O---O---O
	   / \     / \
	  O   O   O   O
	 /     \ /     \
	O---O---O---O---O
	 \     / \     /
	  O   O   O   O
	   \ /     \ /
	    O---O---O
