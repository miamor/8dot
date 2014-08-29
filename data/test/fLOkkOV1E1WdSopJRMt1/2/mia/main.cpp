#include <iostream>
using namespace std;
int main() {
	int a[4], i, j, t;
	cin>>a[0]>>a[1]>>a[2]>>a[3];
	for (i=0;i<3;i++)
		for(j=i+1;j<4;j++)
			t = t + a[j];
	cout<<t<<endl;
	return 0;
}

